<form action="{{ url('save-dtr-adj-request') }}" id="frm-add-dtr-adj-request" data-remote>
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
                            <input type="hidden" name="dtr_adj_req_id" value="{{ isset($dtrAdjRequest) ? $dtrAdjRequest->id : '' }}">
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
                            <small>TIME TYPE</small>
                            {{-- <input type="hidden" name="day[]" value="3"> --}}
                            <select class="custom-select form-control-border" name="time_type" required>
                                <option selected hidden value="">Select Time Type</option>
                                <option value="IN" {{ isset($dtrAdjRequest) ? ($dtrAdjRequest->time_type == 'IN' ? 'selected' : '') : '' }}>IN</option>
                                <option value="OUT" {{ isset($dtrAdjRequest) ? ($dtrAdjRequest->time_type == 'OUT' ? 'selected' : '') : '' }}>OUT</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <small>Transaction Date</small>
                            <div class="input-group date" id="trans_date" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" value="{{ isset($dtrAdjRequest) ? date('m/d/Y H:i:s', strtotime($dtrAdjRequest->trans_date)) : '' }}" name="trans_date" data-target="#trans_date"/>
                                <div class="input-group-append" data-target="#trans_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <small>BRANCH</small>
                            <select class="custom-select form-control-border" name="branch_id" required>
                                <option selected disabled>Select Branch</option>
                                @foreach ($branches as $item)
                                  <option value="{{ $item->id }}" {{ isset($dtrAdjRequest) ? ($dtrAdjRequest->branch_id == $item->id ? 'selected' : '') : '' }}>{{ $item->branch_name }}</option>
                                @endforeach
                            </select>
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