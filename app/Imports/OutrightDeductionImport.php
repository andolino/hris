<?php

namespace App\Imports;

use App\Models\OutrightDeduction;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Carbon;

class OutrightDeductionImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $request = \Request::all();
        $weeklyEmployee = DB::table('employees')->where('bio_id', $row[0])->first();
        return new OutrightDeduction([
            'employee_id' => !empty($weeklyEmployee) ? $weeklyEmployee->id : null,
            'payroll_date' => date('Y-m-d', strtotime($request['payroll_date'])),
            'sss' => $row[4],
            'philhealth' => $row[5],
            'pagibig' => $row[6],
            'tax' => $row[7],
            'cash_adv' => $row[8],
            'accessories' => $row[9],
            'cash_adv_u' => $row[10],
            'created_at' => Carbon::now()
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
