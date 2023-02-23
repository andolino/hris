<?php

namespace App\Imports;

use App\Models\Dtr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DtrImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row){

        if ($row[21] != 'RESIGNED') {
            $employees           = DB::table('employees')->where('bio_id', $row[1])->first();
            $department_schedule = DB::table('department')
                                    ->select('department.*', 
                                        'department_schedule.day_type_id', 
                                        'department_schedule.shifting_id', 
                                        'shifting.grace_period',
                                        'shifting.start_time',
                                        'shifting.end_time',
                                        'shifting.ot_hour')
                                    ->leftJoin('department_schedule', 'department.id', '=', 'department_schedule.department_id')
                                    ->leftJoin('shifting', 'shifting.id', '=', 'department_schedule.shifting_id')
                                    ->where('department.title', $row[21])
                                    ->where('department_schedule.day', date('l', strtotime($row[5])))
                                    ->first();
            if (!empty($employees)) {
                $lateTime = 0;
                $underTime = 0;
                $otTime = 0;
                $expected_ot = 0;
                if (!empty($department_schedule)) {
                    $expected_time_in = $department_schedule->start_time; // expected time in
                    $expected_time_out = $department_schedule->end_time; // expected time in
                    $expected_ot = $department_schedule->ot_hour; // expected time in
                    $time_in = $row[9]; // time in 
                    $time_out = $row[10]; // time out 

                    $lateTime   = $department_schedule->shifting_id != '' ? 
                                ((strtotime($time_in) - strtotime($expected_time_in)) / 3600) - $department_schedule->grace_period :
                                0;

                    $underTime  = $department_schedule->shifting_id != '' && date('H:i:s', strtotime($row[10])) != '00:00:00' ? 
                                ((strtotime($expected_time_out) - strtotime($time_out)) / 3600) :
                                0;
                    
                    $otTime     = $department_schedule->shifting_id != '' && date('H:i:s', strtotime($row[10])) != '00:00:00' ? 
                                ((strtotime($time_out) - strtotime($expected_time_out)) / 3600) :
                                0;
                }
                $request = \Request::all();
                return new Dtr([
                    'employee_id' => $employees->id,
                    'day_type_id' => !empty($department_schedule) ? $department_schedule->day_type_id : null,
                    'shifting_id' => !empty($department_schedule) ? $department_schedule->shifting_id : null,
                    'payroll_date' => date('Y-m-d', strtotime($request['payroll_date'])),
                    'trans_date' => date('Y-m-d', strtotime($row[5])),
                    'time_in' => date('H:i:s', strtotime($row[9])),
                    'time_out' => date('H:i:s', strtotime($row[10])),
                    'late_time' => $lateTime < 0 ? 0 : $lateTime,
                    'under_time' => $underTime < 0 ? 0 : $underTime,
                    'ot_time' => $otTime < 0 ? 0 : $otTime
                ]);
            }
        }
    }

    public function convertLate($start, $end){
        $to_time = strtotime($start);
        $from_time = strtotime($end);
        echo round(abs($to_time - $from_time) / 60, 2);//. " minute";
    }

    public function startRow(): int
    {
        return 2;
    }
}
