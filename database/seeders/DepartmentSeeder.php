<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('department')->insert([
            [
                'title' => 'ACCOUNTING',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'ADMIN',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'HRD',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'IMPEX',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'LOGISTICS',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'MERCHANDISING',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'PRODUCTION',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Q.A',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'RESEARCH AND DEVELOPMENT',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'WAREHOUSE',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'STOCK LOT DEPARMENT',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'STOCKLOT',
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
