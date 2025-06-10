<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'alamat' => 'Fasilkom Unej',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // PABRIK
            [
                'name' => 'GulaLee',
                'email' => 'gulalee@gmail.com',
                'password' => Hash::make('pabrik'),
                'alamat' => 'Jalan jalan kepasar malam, cakep',
                'role' => 'pabrik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Perkasa',
                'email' => 'perkasa@gmail.com',
                'password' => Hash::make('pabrik'),
                'alamat' => 'Sumbersari',
                'role' => 'pabrik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rajawali',
                'email' => 'rajawali@gmail.com',
                'password' => Hash::make('pabrik'),
                'alamat' => 'Ambulu',
                'role' => 'pabrik',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // PETANI
            [
                'name' => 'Rahmad',
                'email' => 'rahmad@gmail.com',
                'password' => Hash::make('petani'),
                'alamat' => 'Wuluhan',
                'role' => 'petani',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Liong',
                'email' => 'liong@gmail.com',
                'password' => Hash::make('petani'),
                'alamat' => 'Bali',
                'role' => 'petani',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Agus',
                'email' => 'agus@gmail.com',
                'password' => Hash::make('petani'),
                'alamat' => 'Jember',
                'role' => 'petani',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
