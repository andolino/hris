<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert(
            [
                [
                    'name' => 'Administrator',
                    'email' => 'email@app.com',
                    'password' => Hash::make('password'),
                    'username' => 'admin',
                    'created_at' => Carbon::now(),
                ]
            ]
        );
    }
}
