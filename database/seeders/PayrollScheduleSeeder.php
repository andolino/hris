<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PayrollScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payroll_schedule')->insert([
            [
                'title' => 'MONTHLY',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'WEEKLY',
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
