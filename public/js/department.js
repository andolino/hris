$(document).ready(function () {

  tblDepartmentSched = $('#tbl-department-schedule').DataTable({
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
      "url": 'server-department-schedule',
      "type": 'POST',
      "data": {
        "_token": $('#tbl-department-schedule').attr('data-csrf'),
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


  tblDepartment = $('#tbl-department').DataTable({
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
        targets: [0, 1, 2],
        className: 'text-left'
      },
      {
        targets: [0, 1, 2],
        orderable: false
      },
    ],
    "serverSide": true,
    "processing": true,
    "ajax": {
      "url": 'server-department',
      "type": 'POST',
      "data": {
        "_token": $('#tbl-department').attr('data-csrf'),
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




