<div class="row">
    {{-- DETAILS --}}
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary">
                <span>{{ $employee->lastname . ', ' . $employee->firstname . ' ' . $employee->middlename }}</span>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-5">
                <label>Payroll Date:</label>
                <input type="hidden" id="employeeId" value="{{ !empty($employee) ? $employee->id : '' }}">
                <select class="custom-select form-control-border" id="payroll_date_payslip">
                    <option value="" hidden selected>Select Year</option>
                    @php
                        for ($i = 0; $i < count($payroll_dates); $i++) { 
                          echo '<option value="'.date('Y-m-d', strtotime($payroll_dates[$i])).'">' . date('Y-m-d', strtotime($payroll_dates[$i])) . '</option>';
                        }
                    @endphp
                </select>
            </div>
        </div>
        <div class="card" id="detail_view_payslip">
            


        </div>
    </div>
    {{-- END PERSONAL INFORMATION --}}
</div>