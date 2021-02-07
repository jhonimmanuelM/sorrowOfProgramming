<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' =>'Admin',
            'email' => 'admin@blackbox.com',
            'password' => Hash::make('admin@123'),
            'employee_number' => 0001
        ]);
    }
}
