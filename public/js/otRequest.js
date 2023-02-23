$(document).ready(function () {
  $(document).on('change', '#day_type_id', function (e) {
    var val = $(this).find(':selected').attr('data-type');
    $('#date_from_to').removeAttr('readonly');
    if (val == 0) {
      $('#date_from_to').daterangepicker({
        // timePicker: true,
        locale: {
          format: 'YYYY-MM-DD h:mm A'
        }
      }, function(start, end, label){
        var s =new Date(start);
        var e =new Date(end);
        var diff = new Date(e - s);
        var days = diff / 1000 / 60 / 60 / 24;
        /**
         * Pending Scenario 
         * Weekends Must be Excluded
         */
        var duration = moment.duration(end.diff(start));
        var hours = duration.asHours();
        $('input[name="date_from"]').val(start.format('YYYY-MM-DD'));
        $('input[name="date_to"]').val(end.format('YYYY-MM-DD'));
        $('input[name="no_of_days"]').val(Math.floor(days) + 1);
        $('input[name="no_of_hours"]').val('');
      })
    } else {
      $('#date_from_to').daterangepicker({
        timePicker: true,
        locale: {
          format: 'YYYY-MM-DD h:mm A'
        }
      }, function(start, end, label){
        var s =new Date(start);
        var e =new Date(end);
        var diff = new Date(e - s);
        var days = diff / 1000 / 60 / 60 / 24;
        /**
         * Pending Scenario 
         * Weekends Must be Excluded
         */
        var duration = moment.duration(end.diff(start));
        var hours = duration.asHours();
        $('input[name="date_from"]').val(start.format('YYYY-MM-DD HH:mm:ss'));
        $('input[name="date_to"]').val(end.format('YYYY-MM-DD HH:mm:ss'));
        $('input[name="no_of_hours"]').val(hours.toFixed(2));
        $('input[name="no_of_days"]').val('');
      })
    }
  });
});


