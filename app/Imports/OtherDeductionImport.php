<?php

namespace App\Imports;

use App\Models\OtherDeduction;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Carbon;

class OtherDeductionImport implements ToModel, WithStartRow
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
        return new OtherDeduction([
            'employee_id' => !empty($weeklyEmployee) ? $weeklyEmployee->id : null,
            'payroll_date' => date('Y-m-d', strtotime($request['payroll_date'])),
            'canteen' => $row[4],
            'union_medical' => $row[5],
            'union_assistance' => $row[6],
            'pa_adj' => $row[7],
            'created_at' => Carbon::now()
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
