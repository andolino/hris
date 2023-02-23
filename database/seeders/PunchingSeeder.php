<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PunchingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('punching')->insert([
            [
                'title' => 'PUNCHING',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'PUNCHING EXCLUDE LATE',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'NON-PUNCHING',
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'NON-PUNCHING EXCLUDE LATE',
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
