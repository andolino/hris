<form action="{{ url('save-dtr-time-in-out') }}" id="frm-update-time-in-out" data-remote>
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
                            <small>Time-out</small>
                            <input type="hidden" name="dtr_id" value="{{ isset($dtr) ? $dtr->id : '' }}" />
                            <div class="input-group date timepicker" id="time_in" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" value="{{ isset($dtr) ? date('h:i A', strtotime($dtr->time_in)) : '' }}" name="start_time" data-target="#time_in"/>
                                <div class="input-group-append" data-target="#time_in" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <small>Time-in</small>
                            <div class="input-group date timepicker" id="time_out" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" value="{{ isset($dtr) ? date('h:i A', strtotime($dtr->time_out)) : '' }}" name="end_time" data-target="#time_out"/>
                                <div class="input-group-append" data-target="#time_out" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-clock"></i></div>
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