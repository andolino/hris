<form action="{{ url('save-add-shifting') }}" id="frm-add-shifting" data-remote>
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
                    <div class="col-sm-4">
                        <div class="form-group">
                            <small>Start Time</small>
                            <input type="hidden" name="shifting_id" value="{{ isset($shifting) ? $shifting->id : '' }}" />
                            <div class="input-group date timepicker" id="time_start" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" value="{{ isset($shifting) ? date('h:i A', strtotime($shifting->start_time)) : '' }}" name="start_time" data-target="#time_start"/>
                                <div class="input-group-append" data-target="#time_start" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <small>End Time</small>
                            <div class="input-group date timepicker" id="time_end" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" value="{{ isset($shifting) ? date('h:i A', strtotime($shifting->end_time)) : '' }}" name="end_time" data-target="#time_end"/>
                                <div class="input-group-append" data-target="#time_end" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <small>Total Hours</small>
                            <input type="text" class="form-control form-control-border" value="{{ isset($shifting) ? $shifting->total_hrs : '' }}" name="total_hrs" readonly/>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <small>Hour Break</small>
                            <input type="text" class="form-control form-control-border" value="{{ isset($shifting) ? $shifting->hr_break : '' }}" name="hr_break" placeholder="ex. 0.25 = 15mins"/>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <small>OT Hour</small>
                            <input type="text" class="form-control form-control-border" value="{{ isset($shifting) ? $shifting->ot_hour : '' }}" name="ot_hour" placeholder="ex. 0.25 = 15mins"/>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <small>Grace Period</small>
                            <input type="text" class="form-control form-control-border" value="{{ isset($shifting) ? $shifting->grace_period : '' }}" name="grace_period" placeholder="ex. 0.25 = 15mins"/>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- END PERSONAL INFORMATION --}}
</div>
</form>