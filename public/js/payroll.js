$(document).ready(function () {
  // payrollList()

  $('#srchPayrollDate').datetimepicker({
    format: 'L' 
  });

  $('#srchPayrollDate').on('change.datetimepicker', function(e){
    var type = $(this).attr('data-type');
    var pDate = moment(e.date).format('YYYY-MM-DD');
    $.ajax({
      type: "POST",
      url: "get-payroll-column",
      data: {
        payroll_date: pDate, 
        'type': type,
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      dataType: "JSON",
      success: function (res) {
        $('#payroll-tbl').html(res.page)
        payrollList(res.col, pDate);
      }
    });
  });

  $(document).on("click", "#infoTbl tbody tr", function() {
      var selected = $(this).hasClass("highlight");
      var refno = $(this).attr("data-refno");
      // $("#infoTbl tr").removeClass("highlight");
      console.log(refno, ' refno')
      var pDate = moment($('input[name="srchPayrollDate"]').val()).format('YYYY-MM-DD');
      var type = $('#srchPayrollDate').attr('data-type');
      if (!selected) {
          $(this).addClass("highlight");
          if (refno != '') {
              $.ajax({
                  type: "POST",
                  url: "remove-deduction",
                  data: { 
                      'is_pause_ded': 1, 
                      'loan_id': refno,
                      '_token': $('#tbl-payroll').attr('data-csrf'),
                      'payroll_date': pDate,
                      'type': type
                  },
                  dataType: "JSON",
                  success: function (res) {
                    tipToast(res.title, res.msg, res.icon, res.cls);
                    $('#payroll-tbl').html(res.page)
                    payrollList(res.col, pDate);
                  }
              });
          }
      } else {
          $(this).removeClass("highlight");
          if (refno != '') {
              $.ajax({
                  type: "POST",
                  url: "remove-deduction",
                  data: { 
                      'is_pause_ded': 0, 
                      'loan_id': refno,
                      '_token': $('#tbl-payroll').attr('data-csrf') 
                  },
                  dataType: "JSON",
                  success: function (res) {
                    tipToast(res.title, res.msg, res.icon, res.cls);
                  }
              });
          }
      }
  });


});


function payrollList(columnObj, pDate){
  var targeNumeric = [];
  for (let i = 4; i < columnObj.length; i++) {
    targeNumeric.push(i);
  }
  $('#tbl-payroll').DataTable().clear().destroy();
  tblPayroll = $('#tbl-payroll').DataTable({
    // responsive: true,
    searchHighlight: true,
    lengthMenu: [[5, 10, 20, 30, 50, 100000], [5, 10, 20, 30, 50, 'All']],
    language: {
      search: '_INPUT_',
      searchPlaceholder: 'Search...',
      lengthMenu: '_MENU_'
    },
    order: false,
    columnDefs: [
      {
        targets: [0, 1, 2, 3],
        className: 'text-left'
      },
      {
        targets: [0, 1, 2, 3, 4, 5, 6],
        orderable: false
      },
      {
        targets: targeNumeric,
        width: 200,
        orderable: false,
        render: function(data, type, row){
          if (!isNaN(parseFloat(data))) {
            return parseFloat(data).toFixed(2);
          }
          return data;
        }
      },
    ],
    initComplete: function () {
      // Attach onchange event listener to search box
      $('#tbl-payroll input').on('change', function () {
        // Get the value of the search box
        var searchValue = this.value;
  
        // Update DataTables ajax data with search value
        $('#tbl-payroll').DataTable().ajax.params({ search: searchValue }).draw();
      });
    },
    // "serverSide": true,
    "processing": true,
    "ajax": {
      "url": 'server-payroll',
      "type": 'POST',
      "data": {
        "_token": $('#tbl-payroll').attr('data-csrf'),
        "payroll_type" : $('#tbl-payroll').attr('data-type'),
        "payroll_date" : pDate
      }
    },
    "columns": columnObj,
    scrollY:        "800px",
    scrollX:        true,
    scrollCollapse: true,
    paging:         false,
    fixedColumns:   {
        left: 4,
        right: 4
    },
    // "responsive": true, 
    // "lengthChange": true, 
    // "autoWidth": true, 
    // "pageLength": 10,
    dom: 'Bfrnltip',
    buttons: [
      'copy', 'csv', 'excel','print', 
      {
        extend: 'pdfHtml5',
        orientation: 'landscape',
        pageSize: 'legal',
        text: 'Preview',
        action: function ( e, dt, node, config ) {
          print_now();
        }
      }
    ],
  });
  tblPayroll.draw();
}