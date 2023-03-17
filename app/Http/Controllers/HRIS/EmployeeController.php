<?php

namespace App\Http\Controllers\HRIS;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use App\Models\Table;


class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){}

    public function saveAddEmployee(Request $request){
        $users = \Auth::user();
        $idcode = $request->idcode;
        $validatedData = $request->validate([
            'punching_id' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'date_hired' => 'required',
            'year_hired' => 'required',
            'employee_status_id' => 'required',
            'position_id' => 'required',
            'department_id' => 'required',
            'payroll_schedule_id' => 'required',
            'employment_status_id' => 'required',
            'birth_date' => 'required',
            'gender' => 'required',
            'civil_status' => 'required',
            'address' => 'required'
        ]);

        $data = [
            'bio_id' => $request->bio_id,
            'punching_id' => $request->punching_id,
            'lastname' => strtoupper($request->lastname),
            'firstname' => strtoupper($request->firstname),
            'middlename' => strtoupper($request->middlename),
            'date_hired' => $request->date_hired,
            'year_hired' => $request->year_hired,
            'employee_status_id' => $request->employee_status_id,
            'position_id' => $request->position_id,
            'department_id' => $request->department_id,
            'payroll_schedule_id' => $request->payroll_schedule_id,
            'employment_status_id' => $request->employment_status_id,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'civil_status' => $request->civil_status,
            'education' => strtoupper($request->education),
            'degree' => strtoupper($request->degree),
            'gov_sss_no' => strtoupper($request->gov_sss_no),
            'gov_philhealth_no' => strtoupper($request->gov_philhealth_no),
            'gov_pagibig_no' => strtoupper($request->gov_pagibig_no),
            'gov_tin_no' => strtoupper($request->gov_tin_no),
            'contact' => $request->contact,
            'address' => strtoupper($request->address),
            'house_no' => $request->house_no,
            'street' => strtoupper($request->street),
            'barangay' => strtoupper($request->barangay),
            'city' => strtoupper($request->city),
            'branch_id' => $users->branch_id
        ];
        $q = false;
        
        $empID = '';
        if ($idcode != '') {
            $employee = DB::table('employees')->where('idcode', $idcode)->first();
            $empID = $employee->id;
            $data['updated_at'] = Carbon::now();
            $q = DB::table('employees')->where('idcode', $idcode)->update($data);
        } else {
            $reference_no = DB::table('reference_no')->orderByDesc('id')->first();
            $data['idcode'] = $reference_no->idcode + 1;
            $data['created_at'] = Carbon::now();
            DB::table('reference_no')->update(['idcode' => $data['idcode']]);
            $employees_id = DB::table('employees')->insertGetId($data); 
            $empID = $employees_id;
        }

        /**
         * Save Dependents
         */
        $dependents = [];
        $fullname = $request->fullname;
        $relation = $request->relation;
        if (count($fullname) > 0) {
            for ($i=0; $i < count($fullname); $i++) { 
                array_push($dependents, array(
                    'fullname' => strtoupper($fullname[$i]),
                    'relation' => strtoupper($relation[$i]),
                    'employees_id' => $empID,
                    'created_at' => Carbon::now()
                ));
            }
            DB::table('dependents')->where('employees_id', $empID)->delete();
            $q = DB::table('dependents')->insert($dependents);
        }

        if ($q) {
            return response()->json([
                'title' => 'Success', 
                'msg' => 'Employee Successfully Saved!', 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-success mr-1'
            ]);
        } else {
            return response()->json([
                'title' => 'Error', 
                'msg' => 'Error on Backend!', 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-danger mr-1'
            ]);
        }
    }

    public function saveSalaryEmployee(Request $request){

        $validatedData = $request->validate([
            'employees_id' => 'required',
            'basic_rate' => 'required',
            'daily_rate' => 'required',
            'hourly_rate' => 'required'
        ],
        [
            'employees_id.required'=> 'Employee is Required',
            'basic_rate.required'=> 'Basic Rate is Required',
            'daily_rate.required'=> 'Daily Rate is Required',
            'hourly_rate.required'=> 'Hourly Rate is Required'
        ]);

        $data = [
            // 'employees_id' => $request->employees_id,
            'basic_rate' => $request->basic_rate,
            'daily_rate' => $request->daily_rate,
            'hourly_rate' => $request->hourly_rate,
            'factor' => $request->factor,
            'ecola' => $request->ecola,
            'subsidy' => $request->subsidy,
            'allowance' => $request->allowance,
            'cba' => $request->cba,
            'overtime_rate' => $request->overtime_rate,
            'is_collect_sss' => $request->is_collect_sss,
            'every_collect_sss' => $request->every_collect_sss,
            'default_collect_sss' => $request->default_collect_sss ?? 0,
            'is_collect_pagibig' => $request->is_collect_pagibig,
            'every_collect_pagibig' => $request->every_collect_pagibig,
            'default_collect_pagibig' => $request->default_collect_pagibig ?? 0,
            'is_collect_phic' => $request->is_collect_phic,
            'every_collect_phic' => $request->every_collect_phic,
            'default_collect_phic' => $request->default_collect_phic ?? 0,
            'is_collect_tax' => $request->is_collect_tax,
            'every_collect_tax' => $request->every_collect_tax,
            'default_collect_tax' => $request->default_collect_tax ?? 0,
            'is_collect_union' => $request->is_collect_union,
            'every_collect_union' => $request->every_collect_union,
            'default_collect_union' => $request->default_collect_union ?? 0
        ];

        try {
            DB::table('employee_salary')->updateOrInsert([
                'employees_id' => $request->employees_id
            ], $data);
            return response()->json([
                'title' => 'Success', 
                'msg' => 'Salary Successfully Saved!', 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-success mr-1'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'title' => 'Error', 
                'msg' => 'Error on Backend!' . $th, 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-danger mr-1'
            ]);
        }
    }

    public function getSsideEmployee(Request $request){
        $initPost = $request->all();
        $result   = Table::getOutputTbl('v_employees', ['idcode',
                                                        'lastname',
                                                        'middlename',
                                                        'firstname',
                                                        'gender',
                                                        'civil_status',
                                                        'department',
                                                        'address',
                                                        'date_hired',
                                                        'employee_status'
                                                    ], ['idcode' => 'desc']);
        $res      = array();
        $no       = isset($initPost['start']) ? $initPost['start'] : 0;

        foreach ($result as $row) {
            $data = array();
            $no++;
            $data[] = $row->idcode;
            $data[] = $row->lastname;
            $data[] = $row->firstname;
            $data[] = $row->middlename;
            $data[] = $row->gender;
            $data[] = $row->civil_status;
            $data[] = $row->department;
            $data[] = $row->address;
            $data[] = $row->date_hired;
            $data[] = $row->employee_status;
            $data[] = '<a href="javascript:void(0);" 
                        class="text-primary" 
                        data-form="mod_emp_form" 
                        data-value="'.$row->idcode.'" 
                        data-type="employee-form-edit" 
                        id="show_form"><i class="fa-solid fa-eye"></i></a> | <a href="#" class="text-danger"><i class="fa-solid fa-trash"></i></a>';
            $res[] = $data;
        }

        $output = array (
            'draw'            => isset($initPost['draw']) ? $initPost['draw'] : null,
            'recordsTotal'    => Table::countAllTbl(),
            'recordsFiltered' => Table::countFilterTbl(),
            'data'            => $res
        );
        echo json_encode($output);
    }

    public function getEmployeeSalaryDetails(Request $request){
        $employees_id = $request->employees_id;
        $employeeSalary = DB::table('employee_salary')->where('employees_id', $employees_id)->first();
        return response()->json($employeeSalary);
    }
}
