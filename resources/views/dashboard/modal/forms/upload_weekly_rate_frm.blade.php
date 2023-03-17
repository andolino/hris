<form action="{{ url('save-import-weekly-rate') }}" method="post" id="frm-import-dtr" data-remote>
  <input type="hidden" name="_redirect_url" value="localhost:://form/index" />
  <input type="hidden" name="_token" value="{{csrf_token()}}" />
  <input type="hidden" name="_method" value="POST" />
  <input type="hidden" name="_confirm_msg" value="Do you want to save the changes?" />
  <input type="hidden" name="_data_type" value="JSON" />
  <input type="hidden" name="_enctype" value="multipart/form-data" />
  <div class="row">
      <div class="col-6">
          {{-- {{ $payroll_type }} --}}
          <div class="form-group">
              <label>Payroll Date:</label>
                  <div class="input-group date" id="payroll_date" data-target-input="nearest">
                      <input type="text" class="form-control datetimepicker-input payroll_date" data-target="#payroll_date" />
                      <div class="input-group-append" data-target="#payroll_date" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                  </div>
              </div>
          <div class="form-group">
              <label>CSV File:</label>
              <input type="file" name="import_file"/>
          </div>
      </div>
  </div>

  <div class="row" id="employee_salary_form">
      
  </div>
</form>