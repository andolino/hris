<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DaytypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('day_type')->insert([
            [
                'title' => 'Regular Day',
                'rate' => 1,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Legal Holiday',
                'rate' => 1.3,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Special Holiday',
                'rate' => 1.3,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Rest Day',
                'rate' => 1,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Rest Day Worked Approved',
                'rate' => 1,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'LH - DayOff',
                'rate' => 1.3,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'SH - DayOff',
                'rate' => 1,
                'ot_rate' => 2.65,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Vacation Leave',
                'rate' => 1,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Sick Leave',
                'rate' => 1,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'OB',
                'rate' => 1,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'OT-Regular',
                'rate' => 1,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Leave W/O Pay',
                'rate' => 1,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => '1/2 Leave w/o Pay',
                'rate' => 0.5,
                'ot_rate' => 0.5,
                'created_at' => Carbon::now()
            ],
            [
                'title' => '1/2 Sick  Leave  w/pay',
                'rate' => 1,
                'ot_rate' => 0.5,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Bereavement',
                'rate' => 1,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Solo Parent',
                'rate' => 1,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'PTO',
                'rate' => 1,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Paternity',
                'rate' => 1,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Flexi Sched',
                'rate' => 1,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Union Holiday',
                'rate' => 1,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Solo Parent',
                'rate' => 1,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Birthday Leave',
                'rate' => 1,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Union Leave',
                'rate' => 1,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Matrimonial',
                'rate' => 1,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => '1/2 Vac Leave w/ Pay',
                'rate' => 0.5,
                'ot_rate' => 0.5,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Magna Carta Leave',
                'rate' => 1,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Offset',
                'rate' => 1,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'OT-Adjustment',
                'rate' => 1,
                'ot_rate' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'title' => 'Halfday',
                'rate' => 0.5,
                'ot_rate' => 0.5,
                'created_at' => Carbon::now()
            ]
        ]);
    }
}
