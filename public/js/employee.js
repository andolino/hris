$(document).ready(function () {
  $(document).on("click", "#add-dep-row", function (e) {
    var element = $('#rowElement tbody').html();
    $(this).parents('tbody').append(element);
  });
  
  $(document).on("click", "#min-dep-row", function (e) {
    $(this).parents('tr').remove();
  });

  tblEmployeeList = $('#tbl-employees-list').DataTable({
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
      "url": 'server-employees-list',
      "type": 'POST',
      "data": {
        "_token": $('#tbl-employees-list').attr('data-csrf'),
        "employee_type": $('#tbl-employees-list').attr('data-employee')
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

});

/**
 * Custom Function
 */
function computeBasicRate(e){
  var val = $(e).val();
  var br = number_format(val);
  var basic_rate = Number(br)
  // daily rate
  $('input[name="daily_rate"]').val(number_format((basic_rate * 12) / 313));
  // hourly rate
  $('input[name="hourly_rate"]').val(number_format((basic_rate * 12) / 313 / 8));
}

