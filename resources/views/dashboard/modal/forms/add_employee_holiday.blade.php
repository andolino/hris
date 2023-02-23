<form action="{{ url('save-employee-holiday') }}" id="frm-add-employee-holiday" data-remote>
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
                            <small>Day Type:</small>
                            <select class="custom-select form-control-border" id="day_type_id" name="day_type_id" required>
                              <option selected hidden value="">Select Day Type</option>
                              @foreach ($day_type as $item)
                                <option value="{{ $item->id }}" {{ $item->id }}" {{ isset($empLeaveRequest) ? ($empLeaveRequest->day_type_id == $item->id ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                              @endforeach
                          </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <small>Name</small>
                            <input type="text" class="form-control form-control-border text-uppercase" name="name"
                                value=""
                                placeholder="Enter Name"
                                required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <small>Date : <span class="text-danger">*</span></small>
                            <div class="input-group date" id="holiday_date" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" value="" name="date" data-target="#holiday_date"/>
                                <div class="input-group-append" data-target="#holiday_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- END PERSONAL INFORMATION --}}
</div>
</form>