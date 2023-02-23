<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class EmployementStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employment_status')->insert([
            [
                'title' => 'REGULAR',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'PROBATIONARY',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'EXTRA',
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
