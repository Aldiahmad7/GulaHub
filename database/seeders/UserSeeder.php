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
            [
                'name' => 'Pabrik GulaLee',
                'email' => 'gulalee@gmail.com',
                'password' => Hash::make('pabrik'),
                'alamat' => 'Jalan jalan kepasar malam, cakep',
                'role' => 'pabrik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Petanigga',
                'email' => 'petanigga@gmail.com',
                'password' => Hash::make('petani'),
                'alamat' => 'Desa Penari',
                'role' => 'petani',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
