<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::insert(
            [
                [
                    'branch_name' => 'Aven',
                    'branch_des' => 'Aven Fashion Mfg. Inc.',
                    'created_at' => Carbon::now()
                ],
                [
                    'branch_name' => 'Sta. Rosa',
                    'branch_des' => 'Sta. Rosa',
                    'created_at' => Carbon::now()
                ],
                [
                    'branch_name' => 'TDO Main',
                    'branch_des' => 'Teladeoro Main',
                    'created_at' => Carbon::now()
                ],
                [
                    'branch_name' => 'Peach Blossom',
                    'branch_des' => 'Peach Blossom Apparel',
                    'created_at' => Carbon::now()
                ]
            ]
        );
    }
}
