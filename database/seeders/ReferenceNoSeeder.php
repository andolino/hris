<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ReferenceNoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = DB::table('employees')->orderByDesc('id')->first();
        if ($employee) {
            DB::table('reference_no')->delete();
            DB::table('reference_no')->insert([
                [
                    'idcode' => $employee->idcode,
                    'created_at' => Carbon::now()
                ]
            ]);    
        } else {
            DB::table('reference_no')->insert([
                [
                    'idcode' => '20220001',
                    'created_at' => Carbon::now()
                ]
            ]);    
        }
        
    }
}
