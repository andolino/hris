
  <form action="{{ url('save-salary-employee') }}" id="frm-employee-salary" data-remote>
    <input type="hidden" name="_redirect_url" value="localhost:://form/index" />
    <input type="hidden" name="_token" value="{{csrf_token()}}" />
    <input type="hidden" name="_method" value="POST" />
    <input type="hidden" name="_confirm_msg" value="Do you want to save the changes?" />
    <input type="hidden" name="_data_type" value="JSON" />
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <small>CHOOSE EMPLOYEE</small>
                <select class="custom-select form-control-border employees_id" data-div="employee_salary_form" data-type="salary-employee-form" id="show_form" name="employees_id">
                    <option></option>
                    @foreach ($employees as $item)
                        <option value="{{ $item->id }}">{{ $item->lastname }}, {{ $item->firstname }} {{ $item->middlename }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row" id="employee_salary_form">
        
    </div>
</form>