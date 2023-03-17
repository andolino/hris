$(document).ready(function () {
  payrollList()
  // $.ajax({
  //   type: "get",
  //   url: "get-payroll-column",
  //   data: {},
  //   dataType: "JSON",
  //   success: function (col) {
  //     payrollList(col);
  //   }
  // });

  

});


function payrollList(){

  tblPayroll = $('#tbl-payroll').DataTable({
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
      "url": 'server-payroll',
      "type": 'POST',
      "data": {
        "_token": $('#tbl-payroll').attr('data-csrf'),
        "payroll_type" : $('#tbl-payroll').attr('data-type')
      }
    },
    // "columns": columnObj,
    "responsive": true, "lengthChange": true, "autoWidth": true, "pageLength": 10,
    scrollX: true,
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