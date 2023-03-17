<?php

namespace App\Imports;

use App\Models\PieceRate;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Carbon;

class PieceRateImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $request = \Request::all();
        $weeklyEmployee = DB::table('employees')->where('bio_id', $row[2])->first();
        return new PieceRate([
            'employee_id' => !empty($weeklyEmployee) ? $weeklyEmployee->id : null,
            'payroll_date' => date('Y-m-d', strtotime($request['payroll_date'])),
            'no_of_days' => $row[4],
            'basic_rate' => $row[5],
            'created_at' => Carbon::now()
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
