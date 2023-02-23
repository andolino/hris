<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class EmployeeStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_status')->insert([
            [
                'title' => 'Active',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Resigned',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Do Not Include',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Terminated',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'End Of Contract',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'AWOL',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'RETIRED',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'For-Termination',
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
