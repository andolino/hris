<?php

namespace App\Http\Controllers\HRIS;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Table;
use App\Imports\DtrImport;
use App\Imports\PieceRateImport;
use App\Imports\OtherDeductionImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;
use DateTime;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function index()
    {
        $title = 'Dashboard';
        return view('dashboard.page.index', compact('title'));
    }

    public function employee_monthly()
    {
        $uri_route  = \Route::current()->uri();
        $title      = 'Employees Monthly';
        $employee   = Employee::select('*', DB::raw('CONCAT(lastname, firstname, lastname) AS full_name'))->get();
        // dd($employee);
        return view('dashboard.page.employee', compact('title', 'employee', 'uri_route'))->with('users', Auth::user());
    }
    
    public function employee_weekly()
    {
        $uri_route  = \Route::current()->uri();
        $title      = 'Employees Weekly';
        $employee   = Employee::select('*', DB::raw('CONCAT(lastname, firstname, lastname) AS full_name'))->get();
        // dd($employee);
        return view('dashboard.page.employee', compact('title', 'employee', 'uri_route'))->with('users', Auth::user());
    }

    public function department(){
        $title = 'Department';
        $department = DB::table('department')->get();
        return view('dashboard.page.department', compact('title', 'department'));
    }
    
    public function departmentSchedule(){
        $title = 'Department Schedule';
        $department_schedule = DB::table('department_schedule')->get();
        return view('dashboard.page.department_schedule', compact('title', 'department_schedule'));
    }
    
    public function dayType(){
        $title = 'Day Type';
        $department = DB::table('day_type')->get();
        return view('dashboard.page.day_type', compact('title', 'department'));
    }
    
    public function shifting(){
        $title = 'Shifting';
        $department = DB::table('shifting')->get();
        return view('dashboard.page.shifting', compact('title', 'department'));
    }
    
    public function dtrList(){
        $title = 'DTR List';
        $dtr = DB::table('shifting')->get();
        return view('dashboard.page.dtr', compact('title', 'dtr'));
    }
    
    public function missedTimeInOut(){
        $title = 'Missed Time-in Time-out';
        return view('dashboard.page.missed_time_in_out', compact('title'));
    }
    
    public function otLeaveRequest(){
        $title = 'OT / Leave Request';
        return view('dashboard.page.ot_leave_request', compact('title'));
    }
    
    public function dtrAdjRequest(){
        $title = 'DTR Adjustment Request';
        return view('dashboard.page.dtr_adj_request', compact('title'));
    }
    
    public function employeeHoliday(){
        $title = 'Holiday';
        return view('dashboard.page.employee_holiday', compact('title'));
    }
    
    public function loanPage(){
        $title = 'Loans';
        return view('dashboard.page.loan_page', compact('title'));
    }
    
    public function monthlyPayroll(){
        $title = 'Monthly Payroll';
        $col = DB::select("call pr_payroll_summary('2023-01-16', 1)");
        $array = get_object_vars($col[0]);
        $column = array_keys($array);
        return view('dashboard.page.monthly_payroll', compact('title', 'column'));
    }
    
    public function weeklyPayroll(){
        $title = 'Weekly Payroll';
        return view('dashboard.page.weekly_payroll', compact('title'));
    }

    public function getWeekOfMonth(Request $request){
        $saturdays = $this->getSaturdaysOfMonth($request->month, $request->year);
        // $saturdays = getSaturdaysOfMonth(2, 2023);
        // foreach ($saturdays as $saturday) {
        //     echo $saturday->format('Y-m-d');
        // }
        return view('dashboard.modal.forms.week_of_month', compact('saturdays'));
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

    public function serverShiftingList(Request $request){
        $initPost = $request->all();
        $result   = Table::getOutputTbl('shifting', ['id',
                                                        'start_time',
                                                        'end_time',
                                                        'total_hrs',
                                                        'hr_break',
                                                        'ot_hour',
                                                        'grace_period',
                                                        'created_at'
                                                    ], ['id' => 'desc']);
        $res      = array();
        $no       = isset($initPost['start']) ? $initPost['start'] : 0;

        foreach ($result as $row) {
            $data = array();
            $no++;
            $data[] = date('h:i:s A', strtotime($row->start_time));
            $data[] = date('h:i:s A', strtotime($row->end_time));
            $data[] = $row->total_hrs;
            $data[] = $row->total_hrs . 'h/' . 
                        (gmdate('H:i', floor($row->hr_break * 3600))) . 
                        ' b/' . (gmdate('H:i', floor($row->grace_period * 3600))) . 
                        ' g/' . (gmdate('H:i', floor($row->ot_hour * 3600))) . ' ot';
            $data[] = '<a href="javascript:void(0);" 
                        class="text-primary" 
                        data-form="mod_shifting_form" 
                        data-value="'.$row->id.'" 
                        data-type="shifting-form" 
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

    public function serverDepartment(Request $request){
        $initPost = $request->all();
        $result   = Table::getOutputTbl('department', ['id',
                                                        'title',
                                                        'created_at'
                                                    ], ['id' => 'asc']);
        $res      = array();
        $no       = isset($initPost['start']) ? $initPost['start'] : 0;

        foreach ($result as $row) {
            $data = array();
            $no++;
            $data[] = $row->id;
            $data[] = $row->title;
            $data[] = '<a href="javascript:void(0);" 
                        class="text-primary" 
                        data-value="'.$row->id.'" 
                        data-type="department-form" 
                        data-form="mod_dep_form" 
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
    
    public function serverDepartmentSchedule(Request $request){
        $initPost = $request->all();
        $result   = Table::getOutputTbl('v_department_schedule', ['id',
                                                        'day_type_name',
                                                        'department_name',
                                                        'start_time',
                                                        'end_time',
                                                        'total_hrs',
                                                        'hr_break',
                                                        'ot_hour',
                                                        'grace_period',
                                                        'created_at'
                                                    ], ['id' => 'asc']);
        $res      = array();
        $no       = isset($initPost['start']) ? $initPost['start'] : 0;

        foreach ($result as $row) {
            $data = array();
            $no++;
            $data[] = $row->department_name;
            $data[] = $row->day_type_name;
            $data[] = $row->day;
            $data[] = $row->start_time == '' ? '' : date('h:i:s A', strtotime($row->start_time));
            $data[] = $row->end_time == '' ? '' : date('h:i:s A', strtotime($row->end_time));
            $data[] = $row->total_hrs;
            $data[] = $row->start_time == '' ? '' : ($row->total_hrs . 'h/' . 
                        (gmdate('H:i', floor($row->hr_break * 3600))) . 
                        ' b/' . (gmdate('H:i', floor($row->grace_period * 3600))) . 
                        ' g/' . (gmdate('H:i', floor($row->ot_hour * 3600))) . ' ot');
            $data[] = '<a href="javascript:void(0);" 
                        class="text-primary" 
                        data-form="mod_dep_form" 
                        data-value="'.$row->department_id.'" 
                        data-type="department-sched-form" 
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
    
    
    public function serverDtrList(Request $request){
        $initPost = $request->all();
        $result   = Table::getOutputTbl('v_dtr', ['id',
                                                    'lastname',
                                                    'firstname',
                                                    'middlename',
                                                    'payroll_date',
                                                    'trans_date',
                                                    'time_in',
                                                    'time_out',
                                                    'late_time',
                                                    'under_time',
                                                    'ot_time',
                                                    'created_at'
                                                ], ['id' => 'asc']);
        $res      = array();
        $no       = isset($initPost['start']) ? $initPost['start'] : 0;

        foreach ($result as $row) {
            $data = array();
            $no++;
            $data[] = strtoupper($row->lastname . ', ' . $row->firstname . ' ' . $row->middlename);
            $data[] = $row->payroll_date != '0000-00-00' ? date('Y-m-d', strtotime($row->payroll_date)) : '0000-00-00';
            $data[] = $row->trans_date != '0000-00-00' ? date('Y-m-d', strtotime($row->trans_date)) : '0000-00-00';
            $data[] = $row->time_in;
            $data[] = $row->time_out;
            $data[] = $row->late_time;
            $data[] = $row->under_time;
            $data[] = $row->ot_time;
            $data[] = '<a href="javascript:void(0);" 
                        class="text-primary" 
                        data-form="mod_dtr_list_form" 
                        data-value="'.$row->id.'" 
                        data-type="dtr-list-form" 
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
    
    public function serverMissedInOut(Request $request){
        $initPost = $request->all();
        $result   = Table::getOutputTbl('v_dtr', ['id',
                                                    'lastname',
                                                    'firstname',
                                                    'middlename',
                                                    'payroll_date',
                                                    'trans_date',
                                                    'time_in',
                                                    'time_out',
                                                    'late_time',
                                                    'under_time',
                                                    'ot_time',
                                                    'created_at'
                                                ], ['id' => 'asc']);
        $res      = array();
        $no       = isset($initPost['start']) ? $initPost['start'] : 0;

        foreach ($result as $row) {
            $data = array();
            $no++;
            $data[] = strtoupper($row->lastname . ', ' . $row->firstname . ' ' . $row->middlename);
            $data[] = $row->payroll_date != '0000-00-00' ? date('Y-m-d', strtotime($row->payroll_date)) : '0000-00-00';
            $data[] = $row->trans_date != '0000-00-00' ? date('Y-m-d', strtotime($row->trans_date)) : '0000-00-00';
            $data[] = $row->time_in;
            $data[] = $row->time_out;
            $data[] = $row->late_time;
            $data[] = $row->under_time;
            $data[] = $row->ot_time;
            $data[] = '<a href="javascript:void(0);" 
                        class="text-primary" 
                        data-form="mod_dep_form" 
                        data-value="'.$row->id.'" 
                        data-type="department-sched-form" 
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
    
    public function serverOtLeaveRequest(Request $request){
        $initPost = $request->all();
        $s = [0 => 'Pending', 1 => 'Approved', 2 => 'Rejected'];
        $sl = [0 => 'badge-warning', 1 => 'badge-success', 2 => 'badge-danger'];
        $result   = Table::getOutputTbl('v_leave_request', ['id',
                                                            'lastname',
                                                            'firstname',
                                                            'middlename',
                                                            'title',
                                                            'transaction_date',
                                                            'date_from',
                                                            'date_to',
                                                            'no_of_days',
                                                            'status',
                                                            'credit_used',
                                                            'created_at'
                                                        ], ['id' => 'asc']);
        $res      = array();
        $no       = isset($initPost['start']) ? $initPost['start'] : 0;

        foreach ($result as $row) {
            $data = array();
            $no++;
            $data[] = strtoupper($row->lastname . ', ' . $row->firstname . ' ' . $row->middlename);
            $data[] = $row->title;
            $data[] = $row->transaction_date != '0000-00-00' ? date('Y-m-d', strtotime($row->transaction_date)) : '0000-00-00';
            $data[] = date('Y-m-d', strtotime($row->date_from));
            $data[] = date('Y-m-d', strtotime($row->date_to));
            $data[] = $row->no_of_days;
            $data[] = $row->no_of_hours;
            $data[] = "<span class='badge ".$sl[$row->status]."'>" . $s[$row->status] . "</span>";
            // $data[] = $row->credit_used;
            $data[] = '<a href="javascript:void(0);" 
                        class="text-primary" 
                        data-form="mod_leave_req_form" 
                        data-value="'.$row->id.'" 
                        data-type="leave-request-form" 
                        id="show_form"><i class="fa-solid fa-eye"></i></a> | <a href="javascript:void(0);" id="tickStatus" 
                                                                                                            data-msg="Are you want to approve this request?" 
                                                                                                            data-tbl="employee_leave_request" 
                                                                                                            data-fld="status" 
                                                                                                            data-val="1"
                                                                                                            data-pkid="'.$row->id.'"
                                                                                class="text-success"><i class="fa fa-check"></i></a>
                                                                            | <a href="javascript:void(0);" id="tickStatus" 
                                                                                                            data-msg="Are you want to reject this request?" 
                                                                                                            data-tbl="employee_leave_request" 
                                                                                                            data-fld="status" 
                                                                                                            data-val="2"
                                                                                                            data-pkid="'.$row->id.'"class="text-danger"><i class="fa fa-times"></i></a> 
                                                                            | <a href="#" class="text-danger"><i class="fa-solid fa-trash"></i></a>';
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
    
    public function serverDtrAdjRequest(Request $request){
        $status = [0 => 'For approval', 1 => 'Approved', 2 => 'Reject'];
        $statusCls = [0 => 'info', 1 => 'success', 2 => 'danger'];
        $initPost = $request->all();
        $result   = Table::getOutputTbl('v_dtr_adj_request', ['id',
                                                            'lastname',
                                                            'firstname',
                                                            'middlename',
                                                            'branch_name',
                                                            'name',
                                                            'trans_date',
                                                            'time_type',
                                                            'status',
                                                            'created_at'
                                                        ], ['id' => 'asc']);
        $res      = array();
        $no       = isset($initPost['start']) ? $initPost['start'] : 0;

        foreach ($result as $row) {
            $data = array();
            $no++;
            $data[] = strtoupper($row->lastname . ', ' . $row->firstname . ' ' . $row->middlename);
            $data[] = $row->time_type;
            $data[] = date('Y-m-d H:i A', strtotime($row->trans_date));
            $data[] = $row->branch_name;
            $data[] = '<span class="badge badge-'.$statusCls[$row->status].'">' . $status[$row->status] . '</span>';
            $data[] = $row->name;
            // $data[] = $row->credit_used;
            $data[] = '<a href="javascript:void(0);" 
                        class="text-primary" 
                        data-form="mod_dtr_adj_form" 
                        data-value="'.$row->id.'" 
                        data-type="dtr-adj-request-form" 
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
    
    public function serverEmployeeHoliday(Request $request){
        $initPost = $request->all();
        $result   = Table::getOutputTbl('v_employee_holiday', ['id',
                                                            'title',
                                                            'name',
                                                            'day',
                                                            'date',
                                                            'created_at'
                                                        ], ['id' => 'asc']);
        $res      = array();
        $no       = isset($initPost['start']) ? $initPost['start'] : 0;

        foreach ($result as $row) {
            $data = array();
            $no++;
            $data[] = $row->title;
            $data[] = $row->name;
            $data[] = date('l', strtotime($row->date));
            $data[] = $row->date != '0000-00-00' ? date('F j, Y', strtotime($row->date)) : '0000-00-00';
            // $data[] = $row->credit_used;
            $data[] = '<a href="javascript:void(0);" 
                        class="text-primary" 
                        data-form="mod_leave_req_form" 
                        data-value="'.$row->id.'" 
                        data-type="leave-request-form" 
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

    public function saveUploadDTR(Request $request){
        // Excel::import(new DtrImport, $request->file('filename'));
        $request->validate([
            'import_file' => 'required|max:10000|mimes:csv',
        ]);
        $dtr = DB::table('dtr')->where('payroll_date', $request->payroll_date)->first();
        if (!empty($dtr)) {
            return response()->json([
                'title' => 'Error', 
                'msg' => 'Payroll Date is Already Exist!', 
                'icon' => 'fas fa-check', 
                'cls' => 'bg-danger mr-1'
            ]);
        }
        $path1 = $request->file('import_file'); 
        try {
            $q = Excel::import(new DtrImport, $path1);
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
        } catch (NoTypeDetectedException $e) {
            echo "Sorry you are using a wrong format to upload files.";
            print_r($e);
        }
        // return redirect()->route('users.index')->with('success', 'User Imported Successfully');
    }

    public function saveImportWeeklyRate(Request $request){
        $request->validate([
            'import_file' => 'required|max:10000|mimes:csv',
        ]);
        $path1 = $request->file('import_file'); 
        try {
            $q = Excel::import(new PieceRateImport, $path1);
            if ($q) {
                return response()->json([
                    'title' => 'Success', 
                    'msg' => 'Piece rate Successfully Saved!', 
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
        } catch (NoTypeDetectedException $e) {
            echo "Sorry you are using a wrong format to upload files.";
            print_r($e);
        }
        // return redirect()->route('users.index')->with('success', 'User Imported Successfully');
    }
    
    public function saveImportOtherDeduction(Request $request){
        $request->validate([
            'import_file' => 'required|max:10000|mimes:csv',
        ]);
        $path1 = $request->file('import_file'); 
        try {
            $q = Excel::import(new OtherDeductionImport, $path1);
            if ($q) {
                return response()->json([
                    'title' => 'Success', 
                    'msg' => 'Piece rate Successfully Saved!', 
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
        } catch (NoTypeDetectedException $e) {
            echo "Sorry you are using a wrong format to upload files.";
            print_r($e);
        }
        // return redirect()->route('users.index')->with('success', 'User Imported Successfully');
    }

    public function serverLoans(Request $request){
        $initPost = $request->all();
        $result   = Table::getOutputTbl('v_loans', ['id',
                                                    'employee_id',
                                                    'loan_type_id',
                                                    'loan_ded_type_id',
                                                    'loan_amount',
                                                    'amortization',
                                                    'date_started',
                                                    'date_end',
                                                    'loan_ref',
                                                    'is_deleted',
                                                    'fullname',
                                                    'loan_types_name',
                                                    'loan_deduction_type',
                                                    'created_at',
                                                    'updated_at'
                                                ], ['id' => 'asc']);
        $res      = array();
        $no       = isset($initPost['start']) ? $initPost['start'] : 0;

        foreach ($result as $row) {
            $data = array();
            $no++;
            $data[] = $row->fullname;
            $data[] = $row->loan_types_name;
            $data[] = $row->loan_deduction_type;
            $data[] = $row->loan_amount;
            $data[] = $row->amortization;
            $data[] = $row->date_started != '0000-00-00' ? date('Y-m-d', strtotime($row->date_started)) : '0000-00-00';
            // $data[] = $row->date_end != '0000-00-00' ? date('Y-m-d', strtotime($row->date_end)) : '0000-00-00';
            // $data[] = $row->credit_used;
            $data[] = '<a href="javascript:void(0);" 
                        class="text-primary" 
                        data-form="mod_leave_req_form" 
                        data-value="'.$row->id.'" 
                        data-type="leave-request-form" 
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
    
    public function serverPayroll(Request $request){
        // $col = DB::select("call pr_payroll_summary('2023-01-16', 1)");
        // $array = get_object_vars($col[0]);
        // $column = array_keys($array);
        // $data = DB::select("call pr_payroll_summary('2023-01-16', 1)");
        // return DataTables::of($data)->make(true);

        $initPost = $request->all();
        $result   = Table::getOutputTbl('v_payroll', ['id',
                                                        'idcode',
                                                        'lastname',
                                                        'firstname',
                                                        'middlename',
                                                        'base_rate',
                                                        'days_worked',
                                                        'ot',
                                                        'sick_leave',
                                                        'vacation_leave',
                                                        'allowance',
                                                        'regular_holiday',
                                                        'special_holiday',
                                                        'subsidy',
                                                        'late',
                                                        'undertime',
                                                        'tot_deductions',
                                                    ], ['id' => 'asc']);
        $res      = array();
        $no       = isset($initPost['start']) ? $initPost['start'] : 0;

        foreach ($result as $row) {
            $data = array();
            $no++;
            $data[] = $row->lastname . ', ' . $row->firstname . ' ' . $row->middlename;
            $data[] = number_format($row->basic_rate, 2);
            $data[] = $row->days_worked;
            $data[] = $row->ot;
            $data[] = $row->sick_leave;
            $data[] = $row->vacation_leave;
            $data[] = $row->allowance;
            $data[] = $row->regular_holiday;
            $data[] = $row->special_holiday;
            $data[] = $row->subsidy;
            $data[] = $row->late;
            $data[] = $row->undertime;
            $data[] = $row->tot_deductions;
            // $data[] = $row->credit_used;
            $data[] = '<a href="javascript:void(0);" 
                        class="text-primary" 
                        data-form="mod_payroll_form" 
                        data-value="'.$row->id.'" 
                        data-type="employee-payroll-details" 
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

}
