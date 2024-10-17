<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Gestor',
            'email' => 'gestor@isp.app',
            'password' => Hash::make('12341234'),
            'is_admin' => true
        ]);

        DB::table('users')->insert([
            'name' => 'Usuario 1',
            'email' => 'user1@isp.app',
            'password' => Hash::make('12341234'),
            'is_admin' => false
        ]);

        DB::table('users')->insert([
            'name' => 'Usuario 2',
            'email' => 'user2@isp.app',
            'password' => Hash::make('12341234'),
            'is_admin' => false
        ]);
    }
}
