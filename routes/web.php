<?php

use App\Http\Controllers\HRIS\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HRIS\BranchController;
use App\Http\Controllers\HRIS\EmployeeController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    /**
     * Pages
     */
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/employee-monthly', [AdminController::class, 'employee_monthly'])->name('employee_monthly');
    Route::get('/employee-weekly', [AdminController::class, 'employee_weekly'])->name('employee_weekly');
    Route::get('/department', [AdminController::class, 'department'])->name('department');
    Route::get('/department-schedule', [AdminController::class, 'departmentSchedule'])->name('departmentschedule');
    Route::get('/day-type', [AdminController::class, 'dayType'])->name('daytype');
    Route::get('/shifting', [AdminController::class, 'shifting'])->name('shifting');
    Route::get('/dtr-list', [AdminController::class, 'dtrList'])->name('dtr_list');
    Route::get('/missed-time-in-out', [AdminController::class, 'missedTimeInOut'])->name('missed_time_in_out');
    Route::get('/ot-leave-request', [AdminController::class, 'otLeaveRequest'])->name('ot_leave_request');
    Route::get('/employee-holiday', [AdminController::class, 'employeeHoliday'])->name('employee_holiday');
    Route::get('/dtr-adj-request', [AdminController::class, 'dtrAdjRequest'])->name('dtr_adj_request');
    Route::get('/loans', [AdminController::class, 'loanPage'])->name('loans');
    Route::get('/payroll-monthly', [AdminController::class, 'monthlyPayroll'])->name('payroll_monthly');
    // ----------------LOGOUT---------------
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    /**
     * Employee
     */
    /**
     * Crud
     */
    Route::post('/save-add-employee', [EmployeeController::class, 'saveAddEmployee']);
    Route::post('/save-salary-employee', [EmployeeController::class, 'saveSalaryEmployee']);
    Route::post('/save-add-department', [HomeController::class, 'saveDepartment']);
    Route::post('/get-reuse-form', [HomeController::class, 'getReuseForm']);
    Route::post('/get-salary-emp-form', [EmployeeController::class, 'getSalaryEmployeeForm']);
    Route::post('/save-add-shifting', [HomeController::class, 'saveAddShifting']);
    Route::post('/save-ot-leave-request', [HomeController::class, 'saveOtLeaveRequest']);
    Route::post('/save-employee-holiday', [HomeController::class, 'saveEmployeeHoliday']);
    Route::post('/save-dtr-time-in-out', [HomeController::class, 'saveDtrTimeInOut']);
    Route::post('/save-dtr-adj-request', [HomeController::class, 'saveDtrAdjRequest']);
    Route::post('/save-loans', [HomeController::class, 'saveLoans']);

    /**
     * Datatable
     */
    Route::post('/server-employees-list', [EmployeeController::class, 'getSsideEmployee']);
    Route::post('/server-shifting-list', [AdminController::class, 'serverShiftingList']);
    Route::post('/server-department-schedule', [AdminController::class, 'serverDepartmentSchedule']);
    Route::post('/save-add-department-sched', [HomeController::class, 'saveAddDepartmentSched']);
    Route::post('/save-import-dtr', [AdminController::class, 'saveUploadDTR']);
    Route::post('/server-dtr-list', [AdminController::class, 'serverDtrList']);
    Route::post('/server-missed-in-out', [AdminController::class, 'serverMissedInOut']);
    Route::post('/server-ot-leave-request', [AdminController::class, 'serverOtLeaveRequest']);
    Route::post('/server-dtr-adj-request', [AdminController::class, 'serverDtrAdjRequest']);
    Route::post('/server-employee-holiday', [AdminController::class, 'serverEmployeeHoliday']);
    Route::post('/server-loans', [AdminController::class, 'serverLoans']);
    Route::post('/server-payroll', [AdminController::class, 'serverPayroll']);
    
    // Route::post('/get-employee-salary-details', [EmployeeController::class, 'getEmployeeSalaryDetails']);

});



// -------------CALLBACK IF ROUTE NOT REDIRECTLY GO TO DASHBOARD-----------------
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
