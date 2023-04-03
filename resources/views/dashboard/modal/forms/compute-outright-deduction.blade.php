<form action="{{ url('save-compute-outright-deduction') }}" method="post" id="frm-compute-outright" data-remote>
  <input type="hidden" name="_redirect_url" value="localhost:://form/index" />
  <input type="hidden" name="_token" value="{{csrf_token()}}" />
  <input type="hidden" name="_method" value="POST" />
  <input type="hidden" name="_confirm_msg" value="Do you want to save the changes?" />
  <input type="hidden" name="_data_type" value="JSON" />
  <input type="hidden" name="type" value="1" />
  {{-- <input type="hidden" name="_enctype" value="multipart/form-data" /> --}}
  <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-secondary">
              <span>COMPUTE OUTRIGHT DEDUCTION</span>
          </div>
        </div>
      </div>
      <div class="col-6">
          {{-- {{ $payroll_type }} --}}
          
          <div class="form-group">
              <label>Payroll Date:</label>
              <div class="input-group date" id="payroll_date" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input payroll_date" name="payroll_date" data-target="#payroll_date" />
                  <div class="input-group-append" data-target="#payroll_date" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                  <div class="input-group-append" 
                          role="button" 
                          data-tbl="outright_deduction"
                          data-msg="Are you sure you want to open this date?"
                          data-field="payroll_date"
                          id="open-payroll-date">
                      <div class="input-group-text">Reopen</div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <div class="row" id="employee_salary_form">
      
  </div>
</form>