<form action="{{ url('save-import-dtr') }}" method="post" id="frm-import-dtr" data-remote>
  <input type="hidden" name="_redirect_url" value="localhost:://form/index" />
  <input type="hidden" name="_token" value="{{csrf_token()}}" />
  <input type="hidden" name="_method" value="POST" />
  <input type="hidden" name="_confirm_msg" value="Do you want to save the changes?" />
  <input type="hidden" name="_data_type" value="JSON" />
  <input type="hidden" name="_enctype" value="multipart/form-data" />
  <div class="row">
      <div class="col-3">
        <div class="form-group">
            <label>Month</label>
            <select class="custom-select form-control-border" id="monthData" onchange="selectedMonthWk()">
                <option value="" hidden selected>Select Month</option>
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
        </div>
      </div>
      <div class="col-3">
        <div class="form-group">
          @php
              // $date = date('Y-01-d');
              // $year = date('Y-m-d', strtotime($date. ' + 5 years'));
          @endphp
            <label>Year</label>
            <select class="custom-select form-control-border" id="getSatWeek">
              <option value="" hidden selected>Select Year</option>
              @php
                  for ($i=-1; $i < 5; $i++) { 
                    echo '<option value="'.date('Y', strtotime('+'.$i.' year')).'" >' . date('Y', strtotime('+'.$i.' year')) . '</option>';
                  }
              @endphp
            </select>
        </div>
      </div>
  </div>
  <div class="row">
      <div class="col-6" id="form-cont-week">
          
      </div>
  </div>

  <div class="row" id="employee_salary_form">
      
  </div>
</form>

<script>
  function selectedMonthWk(){
    var yr = $('#getSatWeek').val();
    if (yr !== '') {
      $('#getSatWeek').trigger('change');
    }
  }

  
</script>