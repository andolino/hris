<form action="{{ url('save-add-employee') }}" id="frm-add-employees" data-remote>
    <input type="hidden" name="_redirect_url" value="localhost:://form/index" />
    <input type="hidden" name="_token" value="{{csrf_token()}}" />
    <input type="hidden" name="_method" value="POST" />
    <input type="hidden" name="_confirm_msg" value="Do you want to save the changes?" />
    <input type="hidden" name="_data_type" value="JSON" />
    
  <div class="row">
      <div class="col-12">
          <div class="form-group">
              <div class="input-group">
                  <div class="custom-file">
                      <input type="file" class="custom-file-input" id="exampleInputFile">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
              </div>
          </div>
      </div>
      {{-- PERSONAL INFORMATION --}}
      <div class="col-12">
          <div class="card">
              <div class="card-header bg-secondary">
                  <span>PERSONAL INFORMATION</span>
              </div>
              <div class="card-body">
                  <div class="row">
                    <div class="col-4">
                      <div class="form-group">
                          <small>IDCODE</small>
                          {{-- <pre>
                            @php
                                print_r($individualEmployee);
                            @endphp
                          </pre> --}}
                          <input type="text" class="form-control form-control-border" name="idcode" 
                            value="{{ isset($individualEmployee) ? $individualEmployee->idcode : '' }}" 
                            readonly>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                          <small>BIO ID</small>
                          <input type="text" class="form-control form-control-border text-uppercase" 
                            value="{{ isset($individualEmployee) ? $individualEmployee->bio_id : '' }}" 
                            name="bio_id">
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                          <small>PUNCHING TYPE</small>
                          <select class="custom-select form-control-border" name="punching_id" required>
                            <option selected hidden value="">Select Punching Type</option>
                            @foreach ($punchingType as $item)
                                <option value="{{ $item->id }}" {{ isset($individualEmployee) ? ($individualEmployee->punching_id == $item->id ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-4">
                          <div class="form-group">
                              <small>FIRSTNAME</small>
                              <input type="text" class="form-control form-control-border text-uppercase" name="firstname"
                                  value="{{ isset($individualEmployee) ? $individualEmployee->firstname : '' }}"
                                  placeholder="Enter Firstname"
                                  required>
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="form-group">
                              <small>LASTNAME</small>
                              <input type="text" class="form-control form-control-border text-uppercase" name="lastname"
                                  value="{{ isset($individualEmployee) ? $individualEmployee->lastname : '' }}"
                                  placeholder="Enter Lastname"
                                  required>
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="form-group">
                              <small>MIDDLE NAME</small>
                              <input type="text" class="form-control form-control-border text-uppercase" name="middlename"
                                  value="{{ isset($individualEmployee) ? $individualEmployee->middlename : '' }}"
                                  placeholder="Enter M.N">
                          </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                            <small>DATE HIRED</small>
                            <input type="date" class="form-control form-control-border text-uppercase" name="date_hired"
                                value="{{ isset($individualEmployee) ? date('Y-m-d', strtotime($individualEmployee->date_hired)) : '' }}"
                                required>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                            <small>YEAR HIRED</small>
                            <input type="text" class="form-control form-control-border text-uppercase" name="year_hired"
                                value="{{ isset($individualEmployee) ? $individualEmployee->year_hired : '' }}"
                                required>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                            <small>EMPLOYEE STATUS</small>
                            <select class="custom-select form-control-border" name="employee_status_id" required>
                              <option selected hidden>Select Employee Status</option>
                              @foreach ($employeeStatus as $item)
                                  <option value="{{ $item->id }}" {{ isset($individualEmployee) ? ($individualEmployee->employee_status_id == $item->id ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                            <small>POSITION</small>
                            <select class="custom-select form-control-border" name="position_id" required>
                              <option selected hidden>Select Position</option>
                              @foreach ($position as $item)
                                  <option value="{{ $item->id }}" {{ isset($individualEmployee) ? ($individualEmployee->position_id == $item->id ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                            <small>DEPARTMENT</small>
                            <select class="custom-select form-control-border" name="department_id" required>
                              <option selected hidden>Select Department</option>
                              @foreach ($department as $item)
                                  <option value="{{ $item->id }}" {{ isset($individualEmployee) ? ($individualEmployee->department_id == $item->id ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                            <small>PAYROLL SCHEDULE</small>
                            <select class="custom-select form-control-border" name="payroll_schedule_id" required>
                              <option selected hidden>Select Payroll Schedule</option>
                              @foreach ($payrollSchedule as $item)
                                  <option value="{{ $item->id }}" {{ isset($individualEmployee) ? ($individualEmployee->payroll_schedule_id == $item->id ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                            <small>EMPLOYMENT STATUS</small>
                            <select class="custom-select form-control-border" name="employment_status_id" required>
                              <option selected hidden>Select Employment Status</option>
                              @foreach ($employmentStatus as $item)
                                  <option value="{{ $item->id }}" {{ isset($individualEmployee) ? ($individualEmployee->employment_status_id == $item->id ? 'selected' : '') : '' }}>{{ $item->title }}</option>
                              @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-4">
                          <div class="form-group">
                              <small>BIRTH DATE</small>
                              <input type="date" class="form-control form-control-border text-uppercase" name="birth_date"
                                  value="{{ isset($individualEmployee) ? date('Y-m-d', strtotime($individualEmployee->birth_date)) : '' }}"
                                  required>
                          </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                            <small>GENDER</small>
                            <select class="custom-select form-control-border" name="gender" required>
                                <option selected hidden>Select Gender</option>
                                <option value="M" {{ isset($individualEmployee) ? ($individualEmployee->gender == 'M' ? 'selected' : '') : '' }}>Male</option>
                                <option value="F" {{ isset($individualEmployee) ? ($individualEmployee->gender == 'F' ? 'selected' : '') : '' }}>Female</option>
                            </select>
                        </div>
                      </div>
                      <div class="col-4">
                          <div class="form-group">
                              <small>CIVIL STATUS</small>
                              <select class="custom-select form-control-border" name="civil_status" required>
                                  <option selected hidden>Select Status</option>
                                  <option value="SINGLE" {{ isset($individualEmployee) ? ($individualEmployee->civil_status == 'SINGLE' ? 'selected' : '') : '' }}>Single</option>
                                  <option value="MARRIED" {{ isset($individualEmployee) ? ($individualEmployee->civil_status == 'MARRIED' ? 'selected' : '') : '' }}>Married</option>
                                  <option value="WIDOWER" {{ isset($individualEmployee) ? ($individualEmployee->civil_status == 'WIDOWER' ? 'selected' : '') : '' }}>Widower</option>
                                  <option value="SEPERATED" {{ isset($individualEmployee) ? ($individualEmployee->civil_status == 'SEPERATED' ? 'selected' : '') : '' }}>Seperated</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="form-group">
                              <small>EDUCATION</small>
                              <input type="text" class="form-control form-control-border text-uppercase" name="education"
                                  value="{{ isset($individualEmployee) ? $individualEmployee->education : '' }}"
                                  placeholder="Enter Education">
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="form-group">
                              <small>DEGREE</small>
                              <input type="text" class="form-control form-control-border text-uppercase" name="degree"
                                  value="{{ isset($individualEmployee) ? $individualEmployee->degree : '' }}"
                                  placeholder="Enter Degree">
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="form-group">
                              <small>SSS No.</small>
                              <input type="text" class="form-control form-control-border text-uppercase" name="gov_sss_no"
                                  value="{{ isset($individualEmployee) ? $individualEmployee->gov_sss_no : '' }}"
                                  placeholder="Enter SSS">
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="form-group">
                              <small>PHILHEALTH No.</small>
                              <input type="text" class="form-control form-control-border text-uppercase" name="gov_philhealth_no"
                                  value="{{ isset($individualEmployee) ? $individualEmployee->gov_philhealth_no : '' }}"
                                  placeholder="Enter Philhealth">
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="form-group">
                              <small>PAGIBIG No.</small>
                              <input type="text" class="form-control form-control-border text-uppercase" name="gov_pagibig_no"
                                  value="{{ isset($individualEmployee) ? $individualEmployee->gov_pagibig_no : '' }}"
                                  placeholder="Enter Pagibig">
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="form-group">
                              <small>TIN No.</small>
                              <input type="text" class="form-control form-control-border text-uppercase" name="gov_tin_no"
                                  value="{{ isset($individualEmployee) ? $individualEmployee->gov_tin_no : '' }}"
                                  placeholder="Enter TIN">
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="form-group">
                              <small>CONTACT No.</small>
                              <input type="text" class="form-control form-control-border text-uppercase" name="contact"
                                  value="{{ isset($individualEmployee) ? $individualEmployee->contact : '' }}"
                                  placeholder="Enter Contact">
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="form-group">
                              <small>ADDRESS</small>
                              <input type="text" class="form-control form-control-border text-uppercase" name="address"
                                  value="{{ isset($individualEmployee) ? $individualEmployee->address : '' }}"
                                  placeholder="Enter Degree"
                                  required>
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="form-group">
                              <small>HOUSE No.</small>
                              <input type="text" class="form-control form-control-border text-uppercase" name="house_no"
                                  value="{{ isset($individualEmployee) ? $individualEmployee->house_no : '' }}"
                                  placeholder="Enter House No">
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="form-group">
                              <small>STREET</small>
                              <input type="text" class="form-control form-control-border text-uppercase" name="street"
                                  value="{{ isset($individualEmployee) ? $individualEmployee->street : '' }}"
                                  placeholder="Enter Street">
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="form-group">
                              <small>BARANGAY</small>
                              <input type="text" class="form-control form-control-border text-uppercase" name="barangay"
                                  value="{{ isset($individualEmployee) ? $individualEmployee->barangay : '' }}"
                                  placeholder="Enter Barangay">
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="form-group">
                              <small>CITY / TOWN</small>
                              <input type="text" class="form-control form-control-border text-uppercase" name="city"
                                  value="{{ isset($individualEmployee) ? $individualEmployee->city : '' }}"
                                  placeholder="Enter City / Town">
                          </div>
                      </div>
                      {{-- <div class="col-4">
                        <div class="form-group">
                            <small>BRANCH</small>
                            <select class="custom-select form-control-border" name="branch_id" required>
                                <option selected disabled>Select Branch</option>
                                @foreach ($branches as $item)
                                  <option value="{{ $item->id }}" {{ isset($individualEmployee) ? ($individualEmployee->branch_id == $item->id ? 'selected' : '') : '' }}>{{ $item->branch_name }}</option>
                                @endforeach
                            </select>
                        </div>
                      </div> --}}
                      
                  </div>
              </div>
          </div>
      </div>
      {{-- END PERSONAL INFORMATION --}}

      {{-- EMPLOYMENT STATUS --}}
      <div class="col-12">
          <div class="card">
              <div class="card-header bg-secondary">
                  <span>OTHER INFORMATION</span>
              </div>
              <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <table class="table table-small" id="tbl-add-dependents">
                        <thead>
                          <tr>
                            <th>NAME</th>
                            <th>RELATION</th>
                            <th>ACTION</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if (isset($indvlDependents) && count($indvlDependents) > 0)
                            @php
                              $ctrl = 0;   
                            @endphp
                            @foreach ($indvlDependents as $item)
                              <tr>
                                <td>
                                  <input type="text" class="form-control form-control-border text-uppercase" name="fullname[]" 
                                      value="{{ $item->fullname }}"
                                      placeholder="...">
                                </td>
                                <td>
                                  <input type="text" class="form-control form-control-border text-uppercase" name="relation[]"
                                      value="{{ $item->relation }}"
                                      placeholder="...">
                                </td>
                                <td class="text-center">
                                  @if ($ctrl == 0)
                                    <a href="javascript:void(0);" class="text-primary" id="add-dep-row"><i class="fa-solid fa-plus"></i></a>
                                  @else
                                    <a href="javascript:void(0);" class="text-primary" id="add-dep-row"><i class="fa-solid fa-plus"></i></a>
                                    <a href="javascript:void(0);" class="text-danger" id="min-dep-row"><i class="fa-solid fa-minus"></i></a>
                                  @endif
                                </td>
                              </tr>
                              @php
                                  $ctrl++;
                              @endphp
                            @endforeach
                          @else
                            <tr>
                              <td>
                                <input type="text" class="form-control form-control-border text-uppercase" name="fullname[]" placeholder="...">
                              </td>
                              <td>
                                <input type="text" class="form-control form-control-border text-uppercase" name="relation[]" placeholder="...">
                              </td>
                              <td class="text-center">
                                <a href="javascript:void(0);" class="text-primary" id="add-dep-row"><i class="fa-solid fa-plus"></i></a>
                              </td>
                            </tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</form>

{{-- hidden element to append row --}}
<table id="rowElement" class="d-none">
  <tr>
    <td>
      <input type="text" class="form-control form-control-border text-uppercase" name="fullname[]" placeholder="...">
    </td>
    <td>
      <input type="text" class="form-control form-control-border text-uppercase" name="relation[]" placeholder="...">
    </td>
    <td class="text-center">
      <a href="javascript:void(0);" class="text-primary" id="add-dep-row"><i class="fa-solid fa-plus"></i></a>
      <a href="javascript:void(0);" class="text-danger" id="min-dep-row"><i class="fa-solid fa-minus"></i></a>
    </td>
  </tr>
</table>