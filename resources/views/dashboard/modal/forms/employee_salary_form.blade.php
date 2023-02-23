<div class="col-12">
  <div class="card">
      <div class="card-header bg-secondary">
          <span>EMPLOYEE SALARY</span>
      </div>
      <div class="card-body">
          <div class="row">
              <div class="col-4">
                  <div class="form-group">
                      <small>Basic Rate</small>
                      <input type="text" onchange="computeBasicRate(this)" 
                          class="form-control form-control-border text-uppercase isNum" 
                          value="{{ isset($employeeSalary) ? $employeeSalary->basic_rate : '' }}" name="basic_rate" 
                          placeholder="0.00">
                  </div>
              </div>
              <div class="col-4">
                  <div class="form-group">
                      <small>Daily Rate</small>
                      <input type="text" class="form-control form-control-border text-uppercase isNum" 
                          name="daily_rate"
                          value="{{ isset($employeeSalary) ? $employeeSalary->daily_rate : '' }}"
                          placeholder="0.00" readonly>
                  </div>
              </div>
              <div class="col-4">
                  <div class="form-group">
                      <small>Hourly Rate</small>
                      <input type="text" class="form-control form-control-border text-uppercase isNum" 
                          name="hourly_rate"
                          value="{{ isset($employeeSalary) ? $employeeSalary->hourly_rate : '' }}"
                          placeholder="0.00" readonly>
                  </div>
              </div>
              <div class="col-4">
                  <div class="form-group">
                      <small>Factor</small>
                      <input type="text" class="form-control form-control-border text-uppercase isNum" 
                          name="factor"
                          value="{{ isset($employeeSalary) ? $employeeSalary->factor : '' }}"
                          placeholder="0.00">
                  </div>
              </div>
              <div class="col-4">
                  <div class="form-group">
                      <small>Ecola/Day</small>
                      <input type="text" class="form-control form-control-border text-uppercase isNum" 
                          name="ecola"
                          value="{{ isset($employeeSalary) ? $employeeSalary->ecola : '' }}"
                          placeholder="0.00">
                  </div>
              </div>
              <div class="col-4">
                  <div class="form-group">
                      <small>Subsidy</small>
                      <input type="text" class="form-control form-control-border text-uppercase isNum" 
                          name="subsidy"
                          value="{{ isset($employeeSalary) ? $employeeSalary->subsidy : '' }}"
                          placeholder="0.00">
                  </div>
              </div>
              <div class="col-4">
                  <div class="form-group">
                      <small>Allowance / Day</small>
                      <input type="text" class="form-control form-control-border text-uppercase isNum" 
                          name="allowance"
                          value="{{ isset($employeeSalary) ? $employeeSalary->allowance : '' }}"
                          placeholder="0.00">
                  </div>
              </div>
              <div class="col-4">
                  <div class="form-group">
                      <small>CBA / Day</small>
                      <input type="text" class="form-control form-control-border text-uppercase isNum" 
                          name="cba"
                          value="{{ isset($employeeSalary) ? $employeeSalary->cba : '' }}"
                          placeholder="0.00">
                  </div>
              </div>
              <div class="col-4">
                  <div class="form-group">
                      <small>Overtime Rate</small>
                      <input type="text" class="form-control form-control-border text-uppercase isNum" name="overtime_rate"
                          value="{{ isset($employeeSalary) ? $employeeSalary->overtime_rate : '' }}"
                          placeholder="0.00">
                  </div>
              </div>
          </div>
      </div>
  </div>


  <div class="card">
      <div class="card-header bg-secondary">
          <span>DEDUCTIONS</span>
      </div>
      <div class="card-body">
          
          <div class="row">
              <div class="col-12">
                  <table class="table table-sm" id="tbl-deduction">
                      <thead class="thead-primary">
                        <tr>
                          <th scope="col">Collection</th>
                          <th scope="col">Yes/No</th>
                          <th scope="col">Every?</th>
                          <th scope="col">Default Value</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Collect SSS</td>
                          <td>
                              <select class="custom-select form-control-border" name="is_collect_sss">
                                  <option selected hidden value="0">--</option>
                                  <option value="1" {{ isset($employeeSalary) ? ($employeeSalary->is_collect_sss == 1 ? 'selected' : '') : '' }}>Yes</option>
                                  <option value="0" {{ isset($employeeSalary) ? ($employeeSalary->is_collect_sss == 0 ? 'selected' : '') : '' }}>No</option>
                              </select>
                          </td>
                          <td>
                              <select class="custom-select form-control-border" name="every_collect_sss">
                                  <option selected hidden value="0">--</option>
                                  <option value="0" {{ isset($employeeSalary) ? ($employeeSalary->every_collect_sss == 0 ? 'selected' : '') : '' }}>Every Payday</option>
                                  <option value="1" {{ isset($employeeSalary) ? ($employeeSalary->every_collect_sss == 1 ? 'selected' : '') : '' }}>First Period</option>
                                  <option value="2" {{ isset($employeeSalary) ? ($employeeSalary->every_collect_sss == 2 ? 'selected' : '') : '' }}>Second Period</option>
                              </select>
                          </td>
                          <td>
                              <input type="text" class="form-control form-control-border text-uppercase isNum" name="default_collect_sss"
                                  value="{{ isset($employeeSalary) ? $employeeSalary->default_collect_sss : '' }}"
                                  placeholder="0.00">
                          </td>
                        </tr>
                        <tr>
                          <td>Collect Pagibig</td>
                          <td>
                              <select class="custom-select form-control-border" name="is_collect_pagibig">
                                  <option selected hidden value="0">--</option>
                                  <option value="1" {{ isset($employeeSalary) ? ($employeeSalary->is_collect_pagibig == 1 ? 'selected' : '') : '' }}>Yes</option>
                                  <option value="0" {{ isset($employeeSalary) ? ($employeeSalary->is_collect_pagibig == 0 ? 'selected' : '') : '' }}>No</option>
                              </select>
                          </td>
                          <td>
                              <select class="custom-select form-control-border" name="every_collect_pagibig">
                                  <option selected hidden value="0">--</option>
                                  <option value="0" {{ isset($employeeSalary) ? ($employeeSalary->every_collect_pagibig == 0 ? 'selected' : '') : '' }}>Every Payday</option>
                                  <option value="1" {{ isset($employeeSalary) ? ($employeeSalary->every_collect_pagibig == 1 ? 'selected' : '') : '' }}>First Period</option>
                                  <option value="2" {{ isset($employeeSalary) ? ($employeeSalary->every_collect_pagibig == 2 ? 'selected' : '') : '' }}>Second Period</option>
                              </select>
                          </td>
                          <td>
                              <input type="text" class="form-control form-control-border text-uppercase isNum" name="default_collect_pagibig"
                                  value="{{ isset($employeeSalary) ? $employeeSalary->default_collect_pagibig : '' }}"
                                  placeholder="0.00">
                          </td>
                        </tr>
                        <tr>
                          <td>Collect PHIC</td>
                          <th>
                              <select class="custom-select form-control-border" name="is_collect_phic">
                                  <option selected hidden value="0">--</option>
                                  <option value="1" {{ isset($employeeSalary) ? ($employeeSalary->is_collect_phic == 1 ? 'selected' : '') : '' }}>Yes</option>
                                  <option value="0" {{ isset($employeeSalary) ? ($employeeSalary->is_collect_phic == 0 ? 'selected' : '') : '' }}>No</option>
                              </select>
                          </th>
                          <td>
                              <select class="custom-select form-control-border" name="every_collect_phic">
                                  <option selected hidden value="0">--</option>
                                  <option value="0" {{ isset($employeeSalary) ? ($employeeSalary->every_collect_phic == 0 ? 'selected' : '') : '' }}>Every Payday</option>
                                  <option value="1" {{ isset($employeeSalary) ? ($employeeSalary->every_collect_phic == 1 ? 'selected' : '') : '' }}>First Period</option>
                                  <option value="2" {{ isset($employeeSalary) ? ($employeeSalary->every_collect_phic == 2 ? 'selected' : '') : '' }}>Second Period</option>
                              </select>
                          </td>
                          <td>
                              <input type="text" class="form-control form-control-border text-uppercase isNum" name="default_collect_phic"
                                  value="{{ isset($employeeSalary) ? $employeeSalary->default_collect_pagibig : '' }}"
                                  placeholder="0.00">
                          </td>
                        </tr>
                        <tr>
                          <td>Collect Tax</td>
                          <td>
                              <select class="custom-select form-control-border" name="is_collect_tax">
                                  <option selected hidden value="0">--</option>
                                  <option value="1" {{ isset($employeeSalary) ? ($employeeSalary->is_collect_tax == 1 ? 'selected' : '') : '' }}>Yes</option>
                                  <option value="0" {{ isset($employeeSalary) ? ($employeeSalary->is_collect_tax == 0 ? 'selected' : '') : '' }}>No</option>
                              </select>
                          </td>
                          <td>
                              <select class="custom-select form-control-border" name="every_collect_tax">
                                  <option selected hidden value="0">--</option>
                                  <option value="0" {{ isset($employeeSalary) ? ($employeeSalary->every_collect_tax == 0 ? 'selected' : '') : '' }}>Every Payday</option>
                                  <option value="1" {{ isset($employeeSalary) ? ($employeeSalary->every_collect_tax == 1 ? 'selected' : '') : '' }}>First Period</option>
                                  <option value="2" {{ isset($employeeSalary) ? ($employeeSalary->every_collect_tax == 2 ? 'selected' : '') : '' }}>Second Period</option>
                              </select>
                          </td>
                          <td>
                              <input type="text" class="form-control form-control-border text-uppercase isNum" name="default_collect_tax"
                                  value="{{ isset($employeeSalary) ? $employeeSalary->default_collect_tax : '' }}"
                                  placeholder="0.00">
                          </td>
                        </tr>
                        <tr>
                          <td>Union Deduction</td>
                          <td>
                              <select class="custom-select form-control-border" name="is_collect_union">
                                  <option selected hidden value="0">--</option>
                                  <option value="1" {{ isset($employeeSalary) ? ($employeeSalary->is_collect_union == 1 ? 'selected' : '') : '' }}>Yes</option>
                                  <option value="0" {{ isset($employeeSalary) ? ($employeeSalary->is_collect_union == 0 ? 'selected' : '') : '' }}>No</option>
                              </select>
                          </td>
                          <td>
                              <select class="custom-select form-control-border" name="every_collect_union">
                                  <option selected hidden value="0">--</option>
                                  <option value="0" {{ isset($employeeSalary) ? ($employeeSalary->every_collect_union == 0 ? 'selected' : '') : '' }}>Every Payday</option>
                                  <option value="1" {{ isset($employeeSalary) ? ($employeeSalary->every_collect_union == 1 ? 'selected' : '') : '' }}>First Period</option>
                                  <option value="2" {{ isset($employeeSalary) ? ($employeeSalary->every_collect_union == 2 ? 'selected' : '') : '' }}>Second Period</option>
                              </select>
                          </td>
                          <td>
                              <input type="text" class="form-control form-control-border text-uppercase isNum" name="default_collect_union"
                                  value="{{ isset($employeeSalary) ? $employeeSalary->default_collect_union : '' }}"
                                  placeholder="0.00">
                          </td>
                        </tr>
                      </tbody>
                  </table>
                    
              </div>
          </div>
      </div>
  </div>
</div>