<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        DB::table('users')->delete();

        DB::table('users')->insert([
            'fname' => 'Edwin',
            'lname' => 'Abril',
            'mname' => 'Trio',
            'username' => 'AdminEdz', 
            'password' => Hash::make('MIS_AdminEdz@24'), 
            'role' => '1',
            'remember_token' => $faker->randomAscii(60),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

