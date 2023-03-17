<form action="{{ url('save-post-monthly') }}" method="post" id="frm-post-payroll" data-remote>
  <input type="hidden" name="_redirect_url" value="localhost:://form/index" />
  <input type="hidden" name="_token" value="{{csrf_token()}}" />
  <input type="hidden" name="_method" value="POST" />
  <input type="hidden" name="_confirm_msg" value="Do you want to save the changes?" />
  <input type="hidden" name="_data_type" value="JSON" />
  {{-- <input type="hidden" name="_enctype" value="multipart/form-data" /> --}}
  <div class="row">
      <div class="col-6">
          {{-- {{ $payroll_type }} --}}
          <div class="form-group">
              <label>Payroll Date:</label>
              <select class="custom-select form-control-border" name="payroll_date" id="post_payroll_date">
                <option value=""></option>
                @php
                    for ($i = 0; $i < count($payroll_dates); $i++) { 
                      echo '<option value="'.date('Y-m-d', strtotime($payroll_dates[$i])).'">' . date('Y-m-d', strtotime($payroll_dates[$i])) . '</option>';
                    }
                @endphp
            </select>
          </div>
      </div>
  </div>

  <div class="row" id="employee_salary_form">
      
  </div>
</form>