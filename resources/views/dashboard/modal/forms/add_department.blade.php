<form action="{{ url('save-add-department') }}" id="frm-add-department" data-remote>
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
                    <div class="col-4">
                        <div class="form-group">
                            <small>Department Name</small>
                            {{--  --}}
                            <input type="text" class="form-control form-control-border text-uppercase" name="title"
                                value="{{ isset($department) ? $department->title : '' }}"
                                placeholder="">
                            <input type="hidden" name="department_id" value="{{ isset($department) ? $department->id : '' }}">
                        </div>
                    </div>
                </div>
                {{-- <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group date" id="time_start" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#time_start" onChange=""/>
                                    <div class="input-group-append" data-target="#time_start" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
    {{-- END PERSONAL INFORMATION --}}
</div>
</form>