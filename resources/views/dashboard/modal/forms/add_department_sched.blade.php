<form action="{{ url('save-add-department-sched') }}" id="frm-add-department" data-remote>
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
                    <div class="col-12">
                        <div class="form-group">
                            <small>Department</small>
                            <input type="hidden" name="department_schedule_id" value="{{ count($department_schedule) > 0 ? $department_schedule[0]->id : '' }}" />
                            <select class="custom-select form-control-border add_dep_sched_select" name="department_id" required>
                                <option selected hidden value="">Select Department</option>
                                @foreach ($department as $item)
                                    <option value="{{ $item->id }}" {{ count($department_schedule) > 0 ? ($department_schedule[0]->department_id == $item->id ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <small>Monday</small>
                            {{-- <input type="hidden" name="day[]" value="1"> --}}
                            <select class="custom-select form-control-border add_dep_sched_select" name="day_type_id[]" required>
                                <option selected hidden value="">Select Day Type</option>
                                @foreach ($dayType as $item)
                                    <option value="{{ $item->id }}" {{ count($department_schedule) > 0 ? ($department_schedule[0]->day_type_id == $item->id ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <small>Shifting</small>
                            <select class="custom-select form-control-border add_dep_sched_select" name="shifting_id[]" required>
                                <option selected hidden value="">Select shifting</option>
                                @foreach ($shifting as $item)
                                    <option value="{{ $item->id }}" {{ count($department_schedule) > 0 ? ($department_schedule[0]->shifting_id == $item->id ? 'selected' : '') : '' }}>{{ date('h:i A', strtotime($item->start_time)) . '-' . 
                                                        date('h:i A', strtotime($item->end_time)) . ' ' . $item->total_hrs . 'h/' . 
                                                            (gmdate('H:i', floor($item->hr_break * 3600))) . 
                                                            ' b/' . (gmdate('H:i', floor($item->grace_period * 3600))) . 
                                                            ' g/' . (gmdate('H:i', floor($item->ot_hour * 3600))) . ' ot' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <small>Tuesday</small>
                            {{-- <input type="hidden" name="day[]" value="2"> --}}
                            <select class="custom-select form-control-border add_dep_sched_select" name="day_type_id[]" required>
                                <option selected hidden value="">Select Day Type</option>
                                @foreach ($dayType as $item)
                                    <option value="{{ $item->id }}" {{ count($department_schedule) > 0 ? ($department_schedule[1]->day_type_id == $item->id ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <small>Shifting</small>
                            <select class="custom-select form-control-border add_dep_sched_select" name="shifting_id[]" required>
                                <option selected hidden value="">Select shifting</option>
                                @foreach ($shifting as $item)
                                    <option value="{{ $item->id }}" {{ count($department_schedule) > 0 ? ($department_schedule[1]->shifting_id == $item->id ? 'selected' : '') : '' }}>{{ date('h:i A', strtotime($item->start_time)) . '-' . 
                                        date('h:i A', strtotime($item->end_time)) . ' ' . $item->total_hrs . 'h/' . 
                                            (gmdate('H:i', floor($item->hr_break * 3600))) . 
                                            ' b/' . (gmdate('H:i', floor($item->grace_period * 3600))) . 
                                            ' g/' . (gmdate('H:i', floor($item->ot_hour * 3600))) . ' ot' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <small>Wednesday</small>
                            {{-- <input type="hidden" name="day[]" value="3"> --}}
                            <select class="custom-select form-control-border add_dep_sched_select" name="day_type_id[]" required>
                                <option selected hidden value="">Select Day Type</option>
                                @foreach ($dayType as $item)
                                    <option value="{{ $item->id }}" {{ count($department_schedule) > 0 ? ($department_schedule[2]->day_type_id == $item->id ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <small>Shifting</small>
                            <select class="custom-select form-control-border add_dep_sched_select" name="shifting_id[]" required>
                                <option selected hidden value="">Select shifting</option>
                                @foreach ($shifting as $item)
                                    <option value="{{ $item->id }}" {{ count($department_schedule) > 0 ? ($department_schedule[2]->shifting_id == $item->id ? 'selected' : '') : '' }}>{{ date('h:i A', strtotime($item->start_time)) . '-' . 
                                        date('h:i A', strtotime($item->end_time)) . ' ' . $item->total_hrs . 'h/' . 
                                            (gmdate('H:i', floor($item->hr_break * 3600))) . 
                                            ' b/' . (gmdate('H:i', floor($item->grace_period * 3600))) . 
                                            ' g/' . (gmdate('H:i', floor($item->ot_hour * 3600))) . ' ot' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <small>Thursday</small>
                            {{-- <input type="hidden" name="day[]" value="4"> --}}
                            <select class="custom-select form-control-border add_dep_sched_select" name="day_type_id[]" required>
                                <option selected hidden value="">Select Day Type</option>
                                @foreach ($dayType as $item)
                                    <option value="{{ $item->id }}" {{ count($department_schedule) > 0 ? ($department_schedule[3]->day_type_id == $item->id ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <small>Shifting</small>
                            <select class="custom-select form-control-border add_dep_sched_select" name="shifting_id[]" required>
                                <option selected hidden value="">Select shifting</option>
                                @foreach ($shifting as $item)
                                    <option value="{{ $item->id }}" {{ count($department_schedule) > 0 ? ($department_schedule[3]->shifting_id == $item->id ? 'selected' : '') : '' }}>{{ date('h:i A', strtotime($item->start_time)) . '-' . 
                                        date('h:i A', strtotime($item->end_time)) . ' ' . $item->total_hrs . 'h/' . 
                                            (gmdate('H:i', floor($item->hr_break * 3600))) . 
                                            ' b/' . (gmdate('H:i', floor($item->grace_period * 3600))) . 
                                            ' g/' . (gmdate('H:i', floor($item->ot_hour * 3600))) . ' ot' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <small>Friday</small>
                            {{-- <input type="hidden" name="day[]" value="5"> --}}
                            <select class="custom-select form-control-border add_dep_sched_select" name="day_type_id[]" required>
                                <option selected hidden value="">Select Day Type</option>
                                @foreach ($dayType as $item)
                                    <option value="{{ $item->id }}" {{ count($department_schedule) > 0 ? ($department_schedule[4]->day_type_id == $item->id ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <small>Shifting</small>
                            <select class="custom-select form-control-border add_dep_sched_select" name="shifting_id[]" required>
                                <option selected hidden value="">Select shifting</option>
                                @foreach ($shifting as $item)
                                    <option value="{{ $item->id }}" {{ count($department_schedule) > 0 ? ($department_schedule[4]->shifting_id == $item->id ? 'selected' : '') : '' }}>{{ date('h:i A', strtotime($item->start_time)) . '-' . 
                                        date('h:i A', strtotime($item->end_time)) . ' ' . $item->total_hrs . 'h/' . 
                                            (gmdate('H:i', floor($item->hr_break * 3600))) . 
                                            ' b/' . (gmdate('H:i', floor($item->grace_period * 3600))) . 
                                            ' g/' . (gmdate('H:i', floor($item->ot_hour * 3600))) . ' ot' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <small>Saturday</small>
                            {{-- <input type="hidden" name="day[]" value="6"> --}}
                            <select class="custom-select form-control-border add_dep_sched_select" name="day_type_id[]" required>
                                <option selected hidden value="">Select Day Type</option>
                                @foreach ($dayType as $item)
                                    <option value="{{ $item->id }}" {{ count($department_schedule) > 0 ? ($department_schedule[5]->day_type_id == $item->id ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <small>Shifting</small>
                            <select class="custom-select form-control-border add_dep_sched_select" name="shifting_id[]" required>
                                <option selected hidden value="">Select shifting</option>
                                @foreach ($shifting as $item)
                                    <option value="{{ $item->id }}" {{ count($department_schedule) > 0 ? ($department_schedule[5]->shifting_id == $item->id ? 'selected' : '') : '' }}>{{ date('h:i A', strtotime($item->start_time)) . '-' . 
                                        date('h:i A', strtotime($item->end_time)) . ' ' . $item->total_hrs . 'h/' . 
                                            (gmdate('H:i', floor($item->hr_break * 3600))) . 
                                            ' b/' . (gmdate('H:i', floor($item->grace_period * 3600))) . 
                                            ' g/' . (gmdate('H:i', floor($item->ot_hour * 3600))) . ' ot' }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <small>Sunday</small>
                            {{-- <input type="hidden" name="day[]" value="7"> --}}
                            <select class="custom-select form-control-border add_dep_sched_select" name="day_type_id[]" required>
                                <option selected hidden value="">Select Day Type</option>
                                @foreach ($dayType as $item)
                                    <option value="{{ $item->id }}" {{ count($department_schedule) > 0 ? ($department_schedule[6]->day_type_id == $item->id ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <small>Shifting</small>
                            <select class="custom-select form-control-border add_dep_sched_select" name="shifting_id[]" required>
                                <option selected hidden value="" {{ count($department_schedule) > 0 ? ($department_schedule[6]->shifting_id == $item->id ? 'selected' : '') : '' }}>Select shifting</option>
                                @foreach ($shifting as $item)
                                    <option value="{{ $item->id }}">{{ date('h:i A', strtotime($item->start_time)) . '-' . 
                                        date('h:i A', strtotime($item->end_time)) . ' ' . $item->total_hrs . 'h/' . 
                                            (gmdate('H:i', floor($item->hr_break * 3600))) . 
                                            ' b/' . (gmdate('H:i', floor($item->grace_period * 3600))) . 
                                            ' g/' . (gmdate('H:i', floor($item->ot_hour * 3600))) . ' ot' }}</option>
                                @endforeach
                            </select>
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