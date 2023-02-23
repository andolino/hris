<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(BranchSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(EmployeeStatusSeeder::class);
        $this->call(EmployementStatusSeeder::class);
        $this->call(PayrollScheduleSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(PunchingSeeder::class);
        $this->call(UserSeeder::class);
    }
}
