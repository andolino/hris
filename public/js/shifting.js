var start_date = [];
var end_date = [];

$(document).ready(function () {
  $(document).on("change.datetimepicker", '#time_start', function (e) {
    var formatedValue = e.date.format(e.date._f);
    var d = moment(formatedValue).format('LT');
    if (d !== 'Invalid date') {
      start_date = [];
      start_date.push(d);
    } else {
      start_date = [];
      start_date.push(formatedValue);
    }
    computeHr();
  });
  $(document).on("change.datetimepicker", '#time_end', function (e) {
    var formatedValue = e.date.format(e.date._f);
    var d = moment(formatedValue).format('LT');
    if (d !== 'Invalid date') {
      end_date = [];
      end_date.push(d);
    } else {
      end_date = [];
      end_date.push(formatedValue);
    }
    computeHr();
  });

  tblShiftingList = $('#tbl-shifting-list').DataTable({
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
        targets: [0, 1, 2, 3, 4],
        orderable: false
      },
    ],
    "serverSide": true,
    "processing": true,
    "ajax": {
      "url": 'server-shifting-list',
      "type": 'POST',
      "data": {
        "_token": $('#tbl-shifting-list').attr('data-csrf'),
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

function computeHr (){
  var startTime = moment(start_date[0], 'HH:mm:ss a')
  var endTime = moment(end_date[0], 'HH:mm:ss a')

  // duration in hours
  var hours = endTime.diff(startTime, 'hours');
  var modHour = hours - 1;
  
  if (modHour < 0) {
    $('input[name="total_hrs"]').val(0);
  } else if(isNaN(modHour)) {
    $('input[name="total_hrs"]').val(0);
  } else {
    $('input[name="total_hrs"]').val(modHour);
  }
}
