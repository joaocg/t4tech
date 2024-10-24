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
        DB::table('users')->updateOrInsert(
            ['email' => 'gestor@isp.app'],
            [
                'name' => 'Gestor',
                'password' => Hash::make('12341234'),
                'is_admin' => true
            ]
        );

        DB::table('users')->updateOrInsert(
            ['email' => 'user1@isp.app'],
            [
                'name' => 'Usuario 1',
                'password' => Hash::make('12341234'),
                'is_admin' => false
            ]
        );

        DB::table('users')->updateOrInsert(
            ['email' => 'user2@isp.app'],
            [
                'name' => 'Usuario 2',
                'password' => Hash::make('12341234'),
                'is_admin' => false
            ]
        );
    }
}
