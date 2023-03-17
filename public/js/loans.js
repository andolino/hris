$(document).ready(function () {

  loansList()

  $(document).on('change', '#employee_id', function () {
    var val = $(this).val();
    $.ajax({
      type: "GET",
      url: "get-employee-data",
      data: { 'employee_id':  val},
      dataType: "JSON",
      success: function (res) {
        $('#payroll_schedule_id').val(res.data.payroll_schedule_id); 
        var ht = '<option selected hidden value="">Select Loan Type</option>';
        $.each(res.dedOptions, function (i, v) { 
           ht+='<option value="'+v.id+'">'+v.title+'</option>';
        });
        $('#loan_ded_type_id').html(ht);
      }
    });
  });
  
  $(document).on('change', '#loan_ded_type_id', function () {
    $('#months').val(''); 
    $('#terms').val('');
    $('input[name="amortization"]').val('');
  });

  $(document).on('change', '#months', function () {
    var payroll_schedule_id = $('#payroll_schedule_id').val(); 
    var employee_id = $('#employee_id').val(); 
    var loan_ded_type_id = $('#loan_ded_type_id').val(); 
    var date_started = $('input[name="date_started"]').val();
    var loan_amount = $('input[name="loan_amount"]').val();
    var months = $('#months').val();
    var terms = $('#terms').val();

    //if weekly
    if (payroll_schedule_id == 2) {
      if (loan_ded_type_id == 1) {
        var trms = months * 4;
        $('#terms').val(trms);
        $('input[name="amortization"]').val(number_format(loan_amount / trms));
      } else {
        $('#terms').val(months);
        $('input[name="amortization"]').val(number_format(loan_amount / months));
      }
    } 
    // monthly
    else {
      if (loan_ded_type_id == 1) {
        var trms = months * 2;
        $('#terms').val(trms);
        $('input[name="amortization"]').val(number_format(loan_amount / trms));
      } else {
        $('#terms').val(months);
        $('input[name="amortization"]').val(number_format(loan_amount / months));
      }
    }


  });


});

function loansList(){
  tblLoans = $('#tbl-loans').DataTable({
    responsive: true,
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
    ],
    "serverSide": true,
    "processing": true,
    "ajax": {
      "url": 'server-loans',
      "type": 'POST',
      "data": {
        "_token": $('#tbl-loans').attr('data-csrf'),
      }
    },
    "responsive": true, "lengthChange": true, "autoWidth": false, "pageLength": 10,
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
}


// if (payroll_schedule_id == 2) {
//   if (loan_ded_type_id == 1) {
//     var mos = [];
//     var weeks = [];
//     var loan_amount = $('input[name="loan_amount"]').val();
//     var ht = '';
//     var noWeeks = (terms * 4);
//     for (let index = 0; index <= terms; index++) {
//       mos.push(moment(date_started).add(index, 'months').format('YYYY-MM-DD'))
//     }
//     var startDate = mos[0];
//     for (var x = 0; x < noWeeks; x++) {
//       weeks.push(moment(startDate).add(x, 'weeks').format('YYYY-MM-DD'));
//     }
//     var mo = parseFloat(loan_amount) / weeks.length;
//     for (let x = 0; x < weeks.length; x++) {
//       ht += '<tr><td>' + weeks[x] + '</td><td>' + number_format(mo) + '</td></tr>';
//     }
//     $('#tbl-loans-rb').find('tbody').html(ht);
//     $('input[name="payment_sched"]').val(mos.join(','));
//     $('input[name="payment_amnt"]').val(mo);
//   } else {
//     // 1st, 2nd, 3rd and 4th period
//     var mos = [];
//     var weeks = [];
//     var loan_amount = $('input[name="loan_amount"]').val();
//     var mo_amort = loan_amount / weeks.length;
//     var ht = '';

//     for (let index = 0; index < terms; index++) {
//       var dayOfWeek = moment(date_started).day();
//       var nextMonth = moment(date_started).clone().add(index, 'month');
//       var nextMonthSameDay = nextMonth.clone().day(dayOfWeek);
//       mos.push(nextMonthSameDay.format('YYYY-MM-DD'))
//     }
//     var mo = parseFloat(loan_amount) / mos.length;
//     for (let x = 0; x < mos.length; x++) {
//       ht += '<tr><td>' + mos[x] + '</td><td>' + number_format(mo) + '</td></tr>';
//     }
//     $('#tbl-loans-rb').find('tbody').html(ht);
//     $('input[name="payment_sched"]').val(mos.join(','));
//     $('input[name="payment_amnt"]').val(mo);
//   }
//   $('button#save').attr('disabled', false);
// } else {
//   var mos = [];
//   var weeks = [];
//   var loan_amount = $('input[name="loan_amount"]').val();
//   var mo_amort = loan_amount / weeks.length;
//   var ht = '';
//   for (let index = 0; index < terms; index++) {
//     mos.push(moment(date_started).add(index, 'months').format('YYYY-MM-DD'))
//   }
//   var mo = parseFloat(loan_amount) / mos.length;
//   for (let x = 0; x < mos.length; x++) {
//     ht += '<tr><td>' + mos[x] + '</td><td>' + number_format(mo) + '</td></tr>';
//   }
//   $('#tbl-loans-rb').find('tbody').html(ht);
//   $('button#save').attr('disabled', false);
// }