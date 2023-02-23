<form action="{{ url('save-loans') }}" id="frm-add-loans" data-remote>
  <input type="hidden" name="_redirect_url" value="localhost:://form/index" />
  <input type="hidden" name="_token" value="{{csrf_token()}}" />
  <input type="hidden" name="_method" value="POST" />
  <input type="hidden" name="_confirm_msg" value="Do you want to save the changes?" />
  <input type="hidden" name="_data_type" value="JSON" />
  
<div class="row">
    {{-- DETAILS --}}
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-secondary">
                <span>DETAILS</span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <small>Employee:</small>
                            {{-- dtrAdjRequest --}}
                            <input type="hidden" name="loan_id" value="{{ isset($dtrAdjRequest) ? $dtrAdjRequest->id : '' }}">
                            <select class="custom-select form-control-border" id="employee_id" name="employee_id" required>
                              <option selected hidden value="">Select Employee</option>
                              @foreach ($employees as $item)
                                  <option value="{{ $item->id }}" {{ isset($dtrAdjRequest) ? ($dtrAdjRequest->employee_id == $item->id ? 'selected' : '') : '' }}>{{ $item->lastname . ', ' . $item->firstname }}</option>
                              @endforeach
                          </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <small>Loan Type:</small>
                            {{-- dtrAdjRequest --}}
                            <select class="custom-select form-control-border" id="employee_id" name="loan_type_id" required>
                              <option selected hidden value="">Select Loan Type</option>
                              @foreach ($loan_types as $item)
                                  <option value="{{ $item->id }}" {{ isset($dtrAdjRequest) ? ($dtrAdjRequest->loan_type_id == $item->id ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                              @endforeach
                          </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <small>Type of Deduction:</small>
                            {{-- dtrAdjRequest --}}
                            <select class="custom-select form-control-border" id="employee_id" name="loan_ded_type_id" required>
                              <option selected hidden value="">Select Loan Type</option>
                              @foreach ($loan_ded_type as $item)
                                  <option value="{{ $item->id }}" {{ isset($dtrAdjRequest) ? ($dtrAdjRequest->loan_ded_type_id == $item->id ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                              @endforeach
                          </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                          <small>Loan Amount</small>
                          <input type="text" class="form-control form-control-border text-uppercase isNum" name="loan_amount"
                              value=""
                              placeholder="Enter Loan Amount"
                              required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                          <small>Amortization</small>
                          <input type="text" class="form-control form-control-border text-uppercase isNum" name="amortization"
                              value=""
                              placeholder="Enter Amortization"
                              readonly
                              required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                          <small>Date Applied: <span class="text-danger">*</span></small>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                            <input type="text" class="form-control float-right" id="date_loan_frm_to">
                            <input type="hidden" class="form-control float-right" name="date_started">
                            <input type="hidden" class="form-control float-right" name="date_end">
                          </div>
                      </div>
                  </div>
                   
                    {{-- <div class="col-sm-4">
                        <div class="form-group">
                            <small>Credit Used</small>
                            <input type="text" class="form-control form-control-border" value="" placeholder=""/>
                        </div>
                    </div> --}}
                </div>

            </div>
        </div>
    </div>
    {{-- END PERSONAL INFORMATION --}}
</div>
</form>