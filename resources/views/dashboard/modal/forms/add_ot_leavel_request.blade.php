<form action="{{ url('save-ot-leave-request') }}" id="frm-add-ot-leave-request" data-remote>
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
                            {{-- empLeaveRequest --}}
                            <input type="hidden" name="employee_leave_request_id" value="{{ isset($empLeaveRequest) ? $empLeaveRequest->id : '' }}">
                            <select class="custom-select form-control-border" id="employee_id" name="employee_id" required>
                              <option selected hidden value="">Select Employee</option>
                              @foreach ($employees as $item)
                                  <option value="{{ $item->id }}" {{ isset($empLeaveRequest) ? ($empLeaveRequest->employee_id == $item->id ? 'selected' : '') : '' }}>{{ $item->lastname . ', ' . $item->firstname }}</option>
                              @endforeach
                          </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <small>Day Type:</small>
                            <select class="custom-select form-control-border" id="day_type_id" name="day_type_id" required>
                              <option selected hidden value="">Select Day Type</option>
                              @foreach ($day_type as $item)
                                  <option value="{{ $item->id }}" data-type="{{ $item->is_ot_under }}" {{ isset($empLeaveRequest) ? ($empLeaveRequest->day_type_id == $item->id ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                              @endforeach
                          </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <small>Transaction Date</small>
                        <div class="input-group date" id="transaction_date" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" value="{{ isset($empLeaveRequest) ? date('m/d/Y', strtotime($empLeaveRequest->transaction_date)) : '' }}" name="transaction_date" data-target="#transaction_date"/>
                            <div class="input-group-append" data-target="#transaction_date" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <small>Date Applied: <span class="text-danger">*</span></small>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                              </div>
                              <input type="text" class="form-control float-right" id="date_from_to" readonly placeholder="Choose Day Type First">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <small>Date From:</small>
                              <input type="text" class="form-control float-right" id="date_from" value="{{ isset($empLeaveRequest) ? date('Y-m-d H:i:s', strtotime($empLeaveRequest->date_from)) : '' }}" readonly name="date_from">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <small>Date To:</small>
                            <input type="text" class="form-control float-right" id="date_to" value="{{ isset($empLeaveRequest) ? date('Y-m-d H:i:s', strtotime($empLeaveRequest->date_to)) : '' }}" readonly name="date_to">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <small>No of days</small>
                            <input type="text" class="form-control form-control-border" value="{{ isset($empLeaveRequest) ? $empLeaveRequest->no_of_days : '' }}" readonly name="no_of_days" placeholder=""/>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <small>No of hours</small>
                            <input type="text" class="form-control form-control-border" value="{{ isset($empLeaveRequest) ? $empLeaveRequest->no_of_hours : '' }}" readonly name="no_of_hours" placeholder=""/>
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