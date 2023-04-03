<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\ComputeDeduction;
use DateTime;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        return view('home');
    }

    public function getReuseForm(Request $request){
        $user = \Auth::user();
        $type = $request->type;
        $val = $request->val;
        $punchingType = DB::table('punching')->get();
        $employeeStatus = DB::table('employee_status')->get();
        $position = DB::table('position')->get();
        $department = DB::table('department')->get();
        $payrollSchedule = DB::table('payroll_schedule')->get();
        $employmentStatus = DB::table('employment_status')->get();
        $branches = DB::table('branches')->get();
        $employees = DB::table('employees')->where('branch_id', $user->branch_id)->get();
        switch ($type) {
            case 'employee-form':
                return view('dashboard.modal.forms.add_employee_form', [
                    'punchingType' => $punchingType,
                    'employeeStatus' => $employeeStatus,
                    'position' => $position,
                    'department' => $department,
                    'payrollSchedule' => $payrollSchedule,
                    'employmentStatus' => $employmentStatus,
                    'branches' => $branches
                ]);
                break;
            case 'employee-form-edit':
                $individualEmployee = DB::table('employees')->where('idcode', $val)->first();
                $indvlDependents = DB::table('dependents')->where('employees_id', $individualEmployee->id)->get();
                return view('dashboard.modal.forms.add_employee_form', [
                    'punchingType' => $punchingType,
                    'employeeStatus' => $employeeStatus,
                    'position' => $position,
                    'department' => $department,
                    'payrollSchedule' => $payrollSchedule,
                    'employmentStatus' => $employmentStatus,
                    'branches' => $branches,
                    'individualEmployee' => $individualEmployee,
                    'indvlDependents' => $indvlDependents
                ]);
                break;
            case 'salary-form':
                return view('dashboard.modal.forms.show_employee_salary', [
                    'employees' => $employees,
                    'payrollSchedule' => $payrollSchedule
                ]);
                break;
            case 'salary-employee-form':
                $employeeSalary = DB::table('employee_salary')->where('employees_id', $val)->first();
                return view('dashboard.modal.forms.employee_salary_form', [
                    'employees' => $employees,
                    'payrollSchedule' => $payrollSchedule,
                    'employeeSalary' => $employeeSalary
                ]);
                break;
            case 'department-form':
                $department = DB::table('department')->where('id', $val)->first();
                return view('dashboard.modal.forms.add_department', [
                    'department' => $department
                ]);
                break;
            case 'department-sched-form':
                $shifting = DB::table('shifting')->select('*')->get();
                $department = DB::table('department')->get();
                $department_schedule = DB::table('department_schedule')->where('department_id', $val)->get();
                $dayType = DB::table('day_type')->get();
                return view('dashboard.modal.forms.add_department_sched', [
                    'shifting' => $shifting,
                    'department' => $department,
                    'dayType' => $dayType,
                    'department_schedule' => $department_schedule
                ]);
                break;
            case 'shifting-form':
                $shifting = DB::table('shifting')->where('id', $val)->first();
                return view('dashboard.modal.forms.add_shifting', [
                    'shifting' => $shifting
                ]);
                break;
            case 'import-dtr-monthly-form':
                $shifting = DB::table('shifting')->where('id', $val)->first();
                // function getSaturdaysOfMonth($month, $year) {
                //     $saturdays = [];
                //     $date = new DateTime("$year-$month-01");
                //     $date->modify('first saturday of this month');
                //     for ($i = 1; $i <= 4; $i++) {
                //         $saturdays[] = clone $date;
                //         $date->modify('+1 week');
                //     }
                //     return $saturdays;
                // }
                
                // $saturdays = getSaturdaysOfMonth(2, 2023);
                // foreach ($saturdays as $saturday) {
                //     echo $saturday->format('Y-m-d') . "\n";
                // }

                return view('dashboard.modal.forms.upload_dtr_frm', [
                    'shifting' => $shifting,
                    'payroll_type' => $request->type
                ]);
                break;
            case 'import-dtr-weekly-form':
                $shifting = DB::table('shifting')->where('id', $val)->first();
                // function getSaturdaysOfMonth($month, $year) {
                //     $saturdays = [];
                //     $date = new DateTime("$year-$month-01");
                //     $date->modify('first saturday of this month');
                //     for ($i = 1; $i <= 4; $i++) {
                //         $saturdays[] = clone $date;
                //         $date->modify('+1 week');
                //     }
                //     return $saturdays;
                // }
                
                // $saturdays = getSaturdaysOfMonth(2, 2023);
                // foreach ($saturdays as $saturday) {
                //     echo $saturday->format('Y-m-d') . "\n";
                // }

                return view('dashboard.modal.forms.upload_dtr_weekly_frm', [
                    'shifting' => $shifting,
                    'payroll_type' => $request->type
                ]);
                break;
            case 'import-piece-rate-form':
                $shifting = DB::table('shifting')->where('id', $val)->first();
                return view('dashboard.modal.forms.upload_weekly_rate_frm', [
                    'shifting' => $shifting,
                    'payroll_type' => $request->type
                ]);
                break;
            case 'import-oth-ded-form':
                $shifting = DB::table('shifting')->where('id', $val)->first();
                return view('dashboard.modal.forms.upload-other-deduction', [
                    'shifting' => $shifting,
                    'payroll_type' => $request->type
                ]);
                break;
            case 'import-outright-ded-form':
                $shifting = DB::table('shifting')->where('id', $val)->first();
                return view('dashboard.modal.forms.upload-outright-deduction', [
                    'shifting' => $shifting,
                    'payroll_type' => $request->type
                ]);
                break;
            case 'compute-outright-ded-form':
                $shifting = DB::table('shifting')->where('id', $val)->first();
                return view('dashboard.modal.forms.compute-outright-deduction', [
                    'shifting' => $shifting,
                    'payroll_type' => $request->type
                ]);
                break;
            case 'leave-request-form':
                $dayType = DB::table('day_type')->get();
                $empLeaveRequest = DB::table('employee_leave_request')->where('id', $val)->first();
                return view('dashboard.modal.forms.add_ot_leavel_request', [
                    'day_type' => $dayType,
                    'employees' => $employees,
                    'empLeaveRequest' => $empLeaveRequest
                ]);
                break;
            case 'employee-holiday-form':
                $employee_holiday = DB::table('employee_holiday')->where('id', $val)->first();
                $dayType = DB::table('day_type')->get();
                return view('dashboard.modal.forms.add_employee_holiday', [
                    'employee_holiday' => $employee_holiday,
                    'day_type' => $dayType
                ]);
                break;
            case 'dtr-list-form':
                $dtr = DB::table('dtr')->where('id', $val)->first();
                return view('dashboard.modal.forms.update_dtr_time', [
                    'dtr' => $dtr
                ]);
                break;
            case 'dtr-adj-request-form':
                $dtrAdjRequest = DB::table('dtr_adj_request')->where('id', $val)->first();
                return view('dashboard.modal.forms.add_dtr_adj_req', [
                    'employees' => $employees,
                    'branches' => $branches,
                    'dtrAdjRequest' => $dtrAdjRequest
                ]);
                break;
            case 'loans-form':
                $loans = DB::table('loans')->where('id', $val)->first();
                $loan_types = DB::table('loan_types')->get();
                $loan_ded_type = DB::table('loan_ded_type')->get();
                return view('dashboard.modal.forms.add_loans', [
                    'loans' => $loans,
                    'employees' => $employees,
                    'loan_types' => $loan_types,
                    'loan_ded_type' => $loan_ded_type
                    // 'dtrAdjRequest' => $dtrAdjRequest
                ]);
                break;
            case 'renewal-loans-form':
                $loans = DB::table('loans')->where('id', $val)->first();
                $loan_types = DB::table('loan_types')->get();
                $loan_ded_type = DB::table('loan_ded_type')->get();
                return view('dashboard.modal.forms.add_renew_loans', [
                    'loans' => $loans,
                    'employees' => $employees,
                    'loan_types' => $loan_types,
                    'loan_ded_type' => $loan_ded_type
                    // 'dtrAdjRequest' => $dtrAdjRequest
                ]);
                break;
            case 'post-payroll-monthly-form':
                $dtr = DB::table('dtr')
                            ->leftJoin('employees', 'employees.id', '=', 'dtr.employee_id')
                            ->where('employees.payroll_schedule_id', 1)
                            ->whereNotIn('dtr.payroll_date', function($q){
                                $q->select('payroll_date')
                                ->from('payroll');
                            })
                            ->get();
                $payroll_dates = [];
                foreach ($dtr as $row) {
                    array_push($payroll_dates, $row->payroll_date);
                }
                $payroll_dates = array_unique($payroll_dates);
                $payroll_dates = array_values($payroll_dates);
                sort($payroll_dates);
                return view('dashboard.modal.forms.post_monthly_payroll', [
                    'payroll_dates' => $payroll_dates
                ]);
                break;
            case 'employee-payroll-details':
                $employee_id = $val;
                // x.employee_id = 290 and x.payroll_schedule_id = 2 and x.payroll_date = '2023-02-18'
                /**
                 * Check if employee is monthly or weekly
                 */
                $employee = DB::table('employees')->where('id', $employee_id)->first();
                $dtr = DB::table('dtr')->where('employee_id', $employee_id)->get();
                $payroll_dates = [];
                foreach ($dtr as $row) {
                    array_push($payroll_dates, $row->payroll_date);
                }
                $payroll_dates = array_unique($payroll_dates);
                $payroll_dates = array_values($payroll_dates);
                sort($payroll_dates);
                return view('dashboard.modal.details.employee_payslip', [
                    'employee' => $employee,
                    'payroll_dates' => $payroll_dates
                    // 'dtrAdjRequest' => $dtrAdjRequest
                ]);
            default:
                # code...
                break;
        }

    }

    public function getPayrollColumn(Request $request){
        $payroll_date = $request->payroll_date;
        $type = $request->type;
        $col = DB::select("call pr_payroll_summary('".$payroll_date."', ".$type.")");
        if (!empty($col)) {
            $array = get_object_vars($col[0]);
            $column = array_keys($array);
            array_push($column, 'Deduction');
            array_push($column, 'Gross Pay');
            array_push($column, 'Net Pay');
            array_push($column, 'Action');
            $data = [];
            for ($i=0; $i < count($column); $i++) { 
                array_push($data, (object) array(
                    "data" => $column[$i],
                    "width" => "30%"
                ));
            }
            if ($type == 2) {
                $page = view('dashboard.modal.details.weekly_payroll_column', compact('column'))->render();
                return response()->json([
                    'page' => $page,
                    'col' => $data
                ]);
            }
            $page = view('dashboard.modal.details.monthly_payroll_column', compact('column'))->render();
            return response()->json([
                'page' => $page,
                'col' => $data
            ]);
        }
    }

    function getSaturdaysOfMonth($month, $year) {
        $saturdays = [];
        $date = new DateTime("$year-$month-01");
        $date->modify('first saturday of this month');
        for ($i = 1; $i <= 4; $i++) {
            $saturdays[] = clone $date;
            $date->modify('+1 week');
        }
        return $saturdays;
    }
    
    function openPayrollDeduction(Request $request) {
        try {
            DB::table($request->tbl)->where($request->field, $request->val)->delete();
            return response()->json([
                'title' => 'Success', 
                'msg' => 'Payroll Date '. date('F j, Y', strtotime($request->val)) .' is now Open..', 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-success mr-1'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'title' => 'Error', 
                'msg' => 'Error on Backend!', 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-danger mr-1'
            ]);
        }
    }
    
    function computeRenewal(Request $request) {
        $loan_id = $request->loan_id;
        $data = [];
        if ($loan_id) {
            for ($i=0; $i < count($loan_id); $i++) { 
                $loans = DB::table('loans')
                        ->selectRaw("(sum(coalesce(loan_details.balance, 0)) - sum(coalesce(loan_details.payment_amount, 0))) as balance")
                        ->leftJoin("loan_details", "loan_details.loan_id", "=", "loans.id")
                        ->where("loans.id", $loan_id[$i])
                        ->groupBy("loans.id")
                        ->first();
                array_push($data, $loans->balance);
            }
        }
        if (count($data) > 0) {
            return response()->json([
                'balance' => array_sum($data),
                'loan_id' => $loan_id
            ]);
        } else {
            return response()->json(['balance' => 0]);
        }
    }

    public function getIndividualPayslip(Request $request){
        $employee_id = $request->employee_id;
        $payroll_date = $request->payroll_date;
        $employee = DB::table('employees')->where('id', $employee_id)->first();
        $details = DB::table('v_payroll_detail')
                        ->where('employee_id', $employee_id)
                        ->where('payroll_schedule_id', $employee->payroll_schedule_id)
                        ->where('payroll_date', $payroll_date)
                        // ->orderByRaw("1, 3, 2, 7, 8, 9")
                        ->get();
        
        /**get current Date */
        $payroll_dates = [];
        $saturdays = $this->getSaturdaysOfMonth(date('m', strtotime($payroll_date)), date('Y', strtotime($payroll_date)));
        foreach ($saturdays as $saturday) {
            array_push($payroll_dates, $saturday->format('Y-m-d'));
        }

        $summarize = DB::table('v_payroll_detail')
                    ->where('employee_id', $employee_id)
                    ->where('payroll_schedule_id', $employee->payroll_schedule_id)
                    ->whereIn('payroll_date', $payroll_dates)
                    // ->orderByRaw("1, 3, 2, 7, 8, 9")
                    ->get();

        $dedtn = 0;
        $ddd = [];
        foreach ($summarize as $row) {
            if ($row->debit != '') {
                $dedtn += $row->debit;
                // echo $row->debit . "\r";
                array_push($ddd, $row->debit);
            }
        }

        if ($details) {
            // monthly
            if ($details[1]->week_count == 0) {
                $deductions = ComputeDeduction::showComputation(floatval(str_replace(',', '', $details[1]->debit)) * 2);
            } 
            // weekly
            else {
                $deductions = ComputeDeduction::showComputation($dedtn);
            }
        }
        return view('dashboard.modal.details.individual_payslip', [
            'details' => $details,
            'deductions' => $deductions
        ]);
    }

    public function computePayroll(){
        $d = ComputeDeduction::showComputation("50000");
        return response()->json($d);
    }

    public function saveDepartment(Request $request){
        $validatedData = $request->validate([
            'title' => 'required',
        ],
        [
            'title.required'=> 'Title is Required',
        ]);
        $data = [
            'title' => $request->title,
            'created_at' => Carbon::now()
        ];
        try {
            DB::table('department')->updateOrInsert([
                'id' => $request->department_id
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
                'msg' => 'Error on Backend!', 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-danger mr-1'
            ]);
        }
    }
    
    
    public function saveAddDepartmentSched(Request $request){
        $validatedData = $request->validate([
            'department_id' => 'required',
        ],
        [
            'title.required'=> 'Department is Required',
        ]);

        $day_type_id = $request->day_type_id;
        $shifting_id = $request->shifting_id;
        $department_schedule_id = $request->department_schedule_id;
        $data = [];
        $ctrl = 0;
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        foreach ($day_type_id as $v) {
            array_push($data, array(
                'department_id' => $request->department_id,
                'day_type_id' => $v,
                'shifting_id' => $shifting_id[$ctrl] == '' ? null : $shifting_id[$ctrl],
                'day' => $days[$ctrl],
                'created_at' => date('Y-m-d H:i:s')
            ));
            $ctrl++;
        }
        try {
            // department_id
            if ($department_schedule_id == '') {
                DB::table('department_schedule')->insert($data);
            } else {
                DB::table('department_schedule')->where('department_id', $request->department_id)->delete();
                DB::table('department_schedule')->insert($data);
            }
            
            return response()->json([
                'title' => 'Success', 
                'msg' => 'Salary Successfully Saved!', 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-success mr-1'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'title' => 'Error', 
                'msg' => 'Error on Backend!', 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-danger mr-1'
            ]);
        }
    }
    
    public function saveAddShifting(Request $request){
        $validatedData = $request->validate([
            'start_time' => 'required',
            'end_time' => 'required',
            'hr_break' => 'required',
            'ot_hour' => 'required',
            'total_hrs' => 'required',
            'grace_period' => 'required'
        ],
        [
            // 'title.required'=> 'Title is Required',
        ]);
        $data = [
            'start_time' => date('H:i:s', strtotime($request->start_time)),
            'end_time' => date('H:i:s', strtotime($request->end_time)),
            'total_hrs' => $request->total_hrs,
            'hr_break' => $request->hr_break,
            'ot_hour' => $request->ot_hour,
            'grace_period' => $request->grace_period,
            'created_at' => Carbon::now()
        ];
        try {
            DB::table('shifting')->updateOrInsert([
                'id' => $request->shifting_id
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
                'msg' => 'Error on Backend!', 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-danger mr-1'
            ]);
        }
    }
    
    public function saveOtLeaveRequest(Request $request){
        $data = $request->all();

        $validatedData = $request->validate([
            'employee_id' => 'required',
            'day_type_id' => 'required',
            'transaction_date' => 'required',
            'date_from' => 'required',
            'date_to' => 'required',
            // 'no_of_days' => 'required',
            // 'no_of_hours' => 'required'
        ],
        [
            'employee_id.required'=> 'Employee is Required',
            'day_type_id.required'=> 'Day Type is Required',
            'transaction_date.required'=> 'Transaction Date is Required',
        ]);
        $data = [
            'employee_id' => $request->employee_id,
            'day_type_id' => $request->day_type_id,
            'transaction_date' => date('Y-m-d', strtotime($request->transaction_date)),
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
            'no_of_days' => $request->no_of_days,
            'no_of_hours' => $request->no_of_hours,
            'created_at' => Carbon::now()
        ];
        try {
            DB::table('employee_leave_request')->updateOrInsert([
                'id' => $request->employee_leave_request_id
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
                'msg' => 'Error on Backend! ' . $th, 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-danger mr-1'
            ]);
        }
    }
    
    public function saveEmployeeHoliday(Request $request){
        $data = $request->all();

        $validatedData = $request->validate([
            'day_type_id' => 'required',
            'name' => 'required',
            'date' => 'required'
        ],
        [
            'day_type_id.required'=> 'Day Type is Required',
            'name.required'=> 'Name is Required',
            'date.required'=> 'Date is Required'
        ]);
        $data = [
            'day_type_id' => $request->day_type_id,
            'name' => $request->name,
            'day' => date('j', strtotime($request->date)),
            'date' => date('Y-m-d', strtotime($request->date)),
            'created_at' => Carbon::now()
        ];
        try {
            DB::table('employee_holiday')->updateOrInsert([
                'id' => $request->employee_holiday_id
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
                'msg' => 'Error on Backend! ' . $th, 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-danger mr-1'
            ]);
        }
    }
    
    public function saveDtrTimeInOut(Request $request){
        $data = $request->all();
        $validatedData = $request->validate([
                'start_time' => 'required',
                'end_time' => 'required'
            ]
            // [
            //     'day_type_id.required'=> 'Day Type is Required',
            //     'name.required'=> 'Name is Required',
            //     'date.required'=> 'Date is Required'
            // ]
        );
        $data = [
            'time_in' => date('H:i:s', strtotime($request->start_time)),
            'time_out' => date('H:i:s', strtotime($request->end_time)),
            'updated_at' => Carbon::now()
        ];
        try {
            DB::table('dtr')->updateOrInsert([
                'id' => $request->dtr_id
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
                'msg' => 'Error on Backend! ' . $th, 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-danger mr-1'
            ]);
        }
    }

    public function saveDtrAdjRequest(Request $request){
        $data = $request->all();
        $user = \Auth::user();
        $validatedData = $request->validate([
                'employee_id' => 'required',
                'trans_date' => 'required',
                'time_type' => 'required',
                'branch_id' => 'required',
            ], [
                'employee_id.required'=> 'Day Type is Required',
                'trans_date.required'=> 'Transaction Date is Required',
                'time_type.required'=> 'Type is Required',
                'branch_id.required'=> 'Branch is Required'
            ]
        );
        $data = [
            'employee_id' => $data['employee_id'],
            'trans_date' => date('Y-m-d H:i:s', strtotime($data['trans_date'])),
            'time_type' => $data['time_type'],
            'branch_id' => $data['branch_id'],
            'user_id' => $user->id,
            'created_at' => Carbon::now()
        ];
        try {
            DB::table('dtr_adj_request')->updateOrInsert([
                'id' => $request->dtr_adj_req_id
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
                'msg' => 'Error on Backend! ' . $th, 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-danger mr-1'
            ]);
        }
    }
    
    public function saveLoans(Request $request){
        $data = $request->all();

        $user = \Auth::user();
        $validatedData = $request->validate([
            'employee_id' => 'required',
            'loan_type_id' => 'required',
            'loan_ded_type_id' => 'required',
            'loan_amount' => 'required',
            'amortization' => 'required',
            'date_started' => 'required',
            // 'date_end' => 'required',
            'months' => 'required',
            'terms' => 'required'
        ], [
            'employee_id.required'=> 'Day Type is Required',
            'loan_type_id.required'=> 'Loan Type is Required',
            'loan_ded_type_id.required'=> 'Deduction Type is Required',
            'loan_amount.required'=> 'Loan Amount is Required',
            'amortization.required'=> 'Amortization is Required',
            'date_started.required'=> 'Date Started is Required',
            // 'date_end.required'=> 'Date End is Required',
            'months.required'=> 'Months is Required',
            'terms.required'=> 'Terms is Required'
        ]);
        $data = [
            'employee_id' => $data['employee_id'],
            'loan_type_id' => $data['loan_type_id'],
            'loan_ded_type_id' => $data['loan_ded_type_id'],
            'loan_amount' => $data['loan_amount'],
            'amortization' => $data['amortization'],
            'date_started' => date('Y-m-d', strtotime($data['date_started'])),
            'months' => $data['months'],
            'terms' => $data['terms'],
            // 'date_end' => $data['date_end'],
            'created_at' => Carbon::now()
        ];
        try {
            $result = DB::table('loans')->updateOrInsert([
                'id' => $request->loan_id
            ], $data);
            if ($result) {
                $id = DB::getPdo()->lastInsertId();
                $terms = $data['terms'];
                $amortization = $data['amortization'];
                $details = [];
                for ($i=0; $i < $terms; $i++) { 
                    array_push($details, array(
                        'loan_id' => $id,
                        'balance' => $data['amortization'],
                        'created_at' => Carbon::now()
                    ));
                }
                DB::table('loan_details')->insert($details);
            }

            return response()->json([
                'title' => 'Success', 
                'msg' => 'Loans Successfully Saved! ', 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-success mr-1'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'title' => 'Error', 
                'msg' => 'Error on Backend! ' . $th, 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-danger mr-1'
            ]);
        }
    }
    
    public function tickStatusOtLeaveRequest(Request $request){
        $data = $request->all();
        $user = \Auth::user();
        try {
            DB::table($data['tbl'])->where('id', $data['pkid'])->update([
                $data['field'] => $data['val']
            ]);
            return response()->json([
                'title' => 'Success', 
                'msg' => 'Saved!', 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-success mr-1'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'title' => 'Error', 
                'msg' => 'Error on Backend! ' . $th, 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-danger mr-1'
            ]);
        }
    }
    
    public function savePostMonthly(Request $request){
        $payroll_date = $request->payroll_date;
        $monthly_employee = DB::table('employees')
                                ->where('payroll_schedule_id', 1)
                                ->where('employee_status_id', 1)
                                ->get();


        foreach ($monthly_employee as $row) {
            $details = DB::table('v_payroll_detail')
                            ->where('employee_id', $row->id)
                            ->where('payroll_schedule_id', 1)
                            ->where('payroll_date', $payroll_date)
                            ->get();
            foreach ($details as $key => $value) {
                # code...
            }
        }
    }
    
    public function getEmployeeData(Request $request){
        $loans = DB::table('loans')
                    ->selectRaw("loans.id, loan_types.title, (sum(coalesce(loan_details.balance, 0)) - sum(coalesce(loan_details.payment_amount, 0))) as balance")
                    ->leftJoin("loan_details", "loan_details.loan_id", "=", "loans.id")
                    ->leftJoin("loan_types", "loan_types.id", "=", "loans.loan_type_id")
                    ->where("loans.employee_id", $request->employee_id)
                    ->groupBy("loans.id")
                    ->get();
        $monthly_employee = DB::table('employees')
                                ->where('id', $request->employee_id)
                                ->first();
        $ded_type = $monthly_employee->payroll_schedule_id;
        if ($ded_type == 2) {
            $dedOptions = DB::table('loan_ded_type')->get();
        } else {
            $dedOptions = DB::table('loan_ded_type')
                                ->whereIn('id', [1, 2, 3])
                                ->get();
        }
        $page = view('dashboard.modal.details.current_active_loans', compact('loans'))->render();
        return response()->json([
            'data'       => $monthly_employee,
            'dedOptions' => $dedOptions,
            'page'       => $page
        ]);
    }
    
    public function saveComputeOutrightDeduction(Request $request){
        $payroll_date = $request->payroll_date;
        $type = $request->type;
        $outright = DB::table('outright_deduction')->where('payroll_date', date('Y-m-d', strtotime($payroll_date)))->first();
        if (!empty($outright)) {
            return response()->json([
                'title' => 'Error', 
                'msg' => date('F j, Y', strtotime($payroll_date)) . ' is already been computed!', 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-danger mr-1',
            ]);
        }

        $summary = DB::select('CALL pr_payroll_summary(?, ?)', array(date('Y-m-d', strtotime($payroll_date)), $type));
        $data = array();
        foreach ($summary as $row) {
            $deduction = ComputeDeduction::showComputation(floatval(str_replace(',', '', $row->{'Basic Rate'})) + floatval(str_replace(',', '', $row->{'Allowance'})));
            array_push($data, array(
                'employee_id' => $row->employee_id,
                'payroll_date' => date('Y-m-d', strtotime($payroll_date)),
                'sss' => $deduction['sss'],
                'philhealth' => $deduction['philhealth'],
                'pagibig' => $deduction['pagibig'],
                'tax' => $deduction['incomeTax'],
                'created_at' => Carbon::now()
            ));
        }
        try {
            DB::table('outright_deduction')->insert($data);
            return response()->json([
                'title' => 'Success', 
                'msg' => date('F j, Y', strtotime($payroll_date)) . ' is already computed!', 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-success mr-1',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'title' => 'Error', 
                'msg' => 'Error on Backend! ' . $th, 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-danger mr-1',
            ]);
        }
    }
    
    public function removeDeduction(Request $request){
        $payroll_date = $request->payroll_date;
        $type = $request->type;
        try {
            DB::table('loans')
                ->where('id', $request->loan_id)
                ->update([
                    'is_pause_ded' => $request->is_pause_ded
                ]);

            $col = DB::select("call pr_payroll_summary('".$payroll_date."', ".$type.")");
            if (!empty($col)) {
                $array = get_object_vars($col[0]);
                $column = array_keys($array);
                array_push($column, 'Deduction');
                array_push($column, 'Gross Pay');
                array_push($column, 'Net Pay');
                array_push($column, 'Action');
                $data = [];
                for ($i=0; $i < count($column); $i++) { 
                    array_push($data, (object) array(
                        "data" => $column[$i],
                        "width" => "30%"
                    ));
                }
                $page = view('dashboard.modal.details.weekly_payroll_column', compact('column'))->render();
                // return response()->json([
                //     'page' => $page,
                //     'col' => $data
                // ]);
            }

            return response()->json([
                'title' => 'Success', 
                'msg' => 'Saved!', 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-success mr-1',
                'page' => $page,
                'col' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'title' => 'Error', 
                'msg' => 'Error on Backend! ' . $th, 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-danger mr-1',
                'page' => $page,
                'col' => $data
            ]);
        }
    }

}
