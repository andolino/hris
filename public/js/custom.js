var tblEmployeeList = [];
var tblShiftingList = [];
var tblDepartment = [];
var tblDepartmentSched = [];
var tblDtrList = [];
var tblMissedInOutList = [];
var tblOtLeaveRequest = [];
var tblEmployeeHoliday = [];
var tblDtrAdjustmentRequest = [];
var tblLoans = [];
var tblPayroll = [];
$(document).ready(function () {
  /** global data table */
  $("#mytable").DataTable({
    "responsive": true, "lengthChange": true, "autoWidth": false, "pageLength": 10,
    "buttons": ["copy", "csv", "excel", "pdf", "print",] //"colvis"]
  }).buttons().container().appendTo('#mytable_wrapper .col-md-6:eq(0)');

  //   $('#example1').DataTable({
  //     "paging": true,
  //     "lengthChange": false,
  //     "searching": true,
  //     "ordering": true,
  //     "info": true,
  //     "autoWidth": true,
  //     "responsive": true,
  //     "scrollX": true
  //   });

  /**
   * Reusable Events
   */
  $(document).on("change", '.isNum', function(e){
    var currentInput = $(this).val();
    var fixedInput = currentInput.replace(/[A-Za-z!@#$%^&*()]/g, '');
    var num = Math.trunc(fixedInput*100)/100;
    $(this).val(Number(num).toFixed(2));//.toString();
  });

  /**
   * Show Form
   */
  // on click event
  $(document).on("click", "#show_form", function (e) {
    var type = $(this).attr('data-type');
    var form = $(this).attr('data-form');
    var val = $(this).attr('data-value');
    $.ajax({
      type: "POST",
      url: "get-reuse-form",
      data: { 
        type: type,
        _token: $('meta[name="csrf-token"]').attr('content'),
        val: val 
      },
      success: function (res) {
        console.log(form, ' form')
        $('#'+form+' .modal-body').html(res);
        $('#'+form).modal('show');
        $('.employees_id').select2({
          allowClear: true,
          dropdownParent: $("#mod_salary_form"),
          placeholder: "Select an Employee",
          width: '100%'
        });
        $('#employee_id').select2({
          placeholder: "Select an Employee",
          width: '100%'
        });
        $('#day_type_id').select2({
          placeholder: "Select an Day Type",
          width: '100%'
        });
        $('#post_payroll_date').select2({
          placeholder: "Select a Date",
          width: '100%'
        });
        $('.add_dep_sched_select').select2({
          placeholder: "Select Department",
          width: '100%',
          allowClear: true
        });
        $('.timepicker').datetimepicker({
          format: 'LT'
        })
        $('#payroll_date').datetimepicker({
          format: 'L'
        });
        $('#transaction_date').datetimepicker({
          format: 'L'
        });
        $('#trans_date').datetimepicker({ icons: { time: 'far fa-clock' } });
        $('#holiday_date').datetimepicker({
          format: 'L'
        });
        // trigger change on update
        $('#day_type_id').trigger('change');
        $('#date_loan_frm_to').daterangepicker({
          timePicker: true,
          // timePickerIncrement: 30,
          locale: {
            format: 'YYYY-MM-DD'
          }
        }, function(start, end, label){
          var loan_amount = $('input[name="loan_amount"]').val();
          if (loan_amount <= 0) {
            Swal.fire(
              'Opps!',
              'Please Input Loan Amount!',
              'error'
            )
          } else {
            var s =new Date(start);
            var e =new Date(end);
            var diff = new Date(e - s);
            var days = diff / 1000 / 60 / 60 / 24;
            var duration = moment.duration(end.diff(start));
            var months = duration.asMonths();
            $('input[name="date_started"]').val(start.format('YYYY-MM-DD'));
            $('input[name="date_end"]').val(end.format('YYYY-MM-DD'));

            $('input[name="amortization"]').val((loan_amount / months.toFixed(2)).toFixed(2));
          }
        })
        
      }
    });
  });

  // on change event
  $(document).on("change", "#show_form", function (e) {
    var type = $(this).attr('data-type');
    var div = $(this).attr('data-div');
    var val = $(this).val();
    $.ajax({
      type: "POST",
      url: "get-reuse-form",
      data: { 
        type: type,
        _token: $('meta[name="csrf-token"]').attr('content'),
        val: val 
      },
      success: function (res) {
        $('#'+div).html(res);
      }
    });
  });

  function refreshDataTable(){
    if ($.fn.DataTable.isDataTable('#tbl-employees-list')) {
      tblEmployeeList.ajax.reload();
    } else if($.fn.DataTable.isDataTable('#tbl-shifting-list')){
      tblShiftingList.ajax.reload();
    } else if($.fn.DataTable.isDataTable('#tbl-department-schedule')){
      tblDepartmentSched.ajax.reload(); 
    } else if($.fn.DataTable.isDataTable('#tbl-ot-leave-request')){
      tblOtLeaveRequest.ajax.reload(); 
    } else if($.fn.DataTable.isDataTable('#tbl-employee-holiday')){
      tblEmployeeHoliday.ajax.reload(); 
    } else if($.fn.DataTable.isDataTable('#tbl-dtr-list')){
      tblDtrList.ajax.reload(); 
    } else if($.fn.DataTable.isDataTable('#tbl-dtr-adjustment-request')){
      tblDtrAdjustmentRequest.ajax.reload(); 
    } else if($.fn.DataTable.isDataTable('#tbl-department')){
      tblDepartment.ajax.reload(); 
    }
  }

  /**
   * Submit Data
   */
  $(document).on('submit', 'form[data-remote]', function (e) {
    e.preventDefault();
    var form = $(this);
    var url = form.prop('action');
    var method = form.find('input[name="_method"]').val();
    var redirectUrl = form.find('input[name="_redirect_url"]').val();
    var confirmMsg = form.find('input[name="_confirm_msg"]').val();
    var dataType = form.find('input[name="_data_type"]').val();
    var encType = form.find('input[name="_enctype"]').val();
    // var myForm = form.serializeArray();
    var options = {
      type: method,
      url: url,
      dataType: dataType,
      beforeSend: function(){
        $('#loader').removeClass('hidden')
      },
      success: function (res) {
        tipToast(res.title, res.msg, res.icon, res.cls);
        $('.modal').modal('hide');
        refreshDataTable();
      },
      error: function (reject) {
        if( reject.status === 422 ) {
            var errors = $.parseJSON(reject.responseText);
            $.each(errors.errors, function (key, val) {
              tipToast('Sorry ', val[0], 'fas fa-times', 'bg-danger mr-1');
            });
        }
      },
      complete: function(){
        $('#loader').addClass('hidden')
        $('#mod_upload_dtr_form').modal('hide');
      }
    };

    if (typeof encType !== 'undefined') {
      var myForm = new FormData();
      myForm.append('import_file', $('input[type=file]')[0].files[0]);
      myForm.append('payroll_date', $('.payroll_date').val());
      myForm.append('_token', $('input[name=_token]').val());
      options.data = myForm;
      options.contentType = false;
      options.processData = false;
    } else {
      options.data = form.serializeArray();
    }

    Swal.fire({
      title: confirmMsg,
      showDenyButton: true,
      confirmButtonText: 'Yes',
      denyButtonText: `Wait`,
      icon: 'question'
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {

        $.ajax(options);
        // console.log(options, ' options');
      } else if (result.isDenied) {
        // $('#mod_emp_form').modal('hide');
      }
    })
  });

  $(document).on('click', '#tickStatus', function () {
    var confirmMsg = $(this).attr('data-msg');
    var tbl = $(this).attr('data-tbl');
    var field = $(this).attr('data-fld');
    var pkid = $(this).attr('data-pkid');
    var val = $(this).attr('data-val');

    Swal.fire({
      title: confirmMsg,
      showDenyButton: true,
      confirmButtonText: 'Yes',
      denyButtonText: `Wait`,
      icon: 'question'
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {

        $.ajax({
          type: "POST",
          url: "tick-status-ot-leave-request",
          data: { 
            'msg': confirmMsg,
            'tbl': tbl,
            'field': field,
            'val': val,
            'pkid' : pkid,
            _token: $('meta[name="csrf-token"]').attr('content')
          },
          dataType: "json",
          success: function (res) {
            refreshDataTable();
            tipToast(res.title, res.msg, res.icon, res.cls);
          }
        });
        // console.log(options, ' options');
      } else if (result.isDenied) {
        // $('#mod_emp_form').modal('hide');
      }
    })
  });
  
  $(document).on('change', '#getSatWeek', function () {
    var monthData = $('#monthData').val();
    var yr = $(this).val();
    $.ajax({
      type: "get",
      url: "get-week-of-month",
      data: { 
        'month': monthData,
        'year': yr
      },
      success: function (res) {
        $('#form-cont-week').html(res);
      }
    });
  });
  
  $(document).on('change', '#payroll_date_payslip', function () {
    var payroll_date = $(this).val();
    var employee_id = $('#employeeId').val();
    $.ajax({
      type: "POST",
      url: "get-individual-payslip",
      data: { 
        'payroll_date': payroll_date,
        'employee_id': employee_id,
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      success: function (res) {
        $('#detail_view_payslip').html(res);
      }
    });
  });


});

function tipToast(label, body, icon, cls){
  $(document).Toasts('create', {
    title: label,
    body: body,
    icon: icon,
    class: cls,
    autohide: true,
    delay: 5000
  })
}

function number_format(number) {
  var num = Math.trunc(number*100)/100;
  return Number(num).toFixed(2);
}



