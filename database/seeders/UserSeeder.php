<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Resident;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => '1',
            'name' => 'Admin Nagari',
            'email' => 'admin@gmail.com',
            'password' => 'password',
            'status' => 'approved',
            'role_id' => '1', // admin
        ]);

        User::create([
            'id' => '2',
            'name' => 'Penduduk 1',
            'email' => 'penduduk1@gmail.com',
            'password' => 'password',
            'status' => 'approved',
            'role_id' => '2', // user
        ]);

        Resident::create([
            'user_id' => '2',
            'nik' => '1234567890123456',
            'name' => 'Penduduk 1',
            'gender' => 'Pria',
            'birth_date' => '2000-01-01',
            'birth_place' => 'Jakarta',
            'address' => 'Jl. Contoh No. 123',
            'religion' => 'Islam',
            'marital_status' => 'Belum Menikah',
            'occupation' => 'Pekerja',
            'phone' => '08123456789',
            'status' => 'Aktif',
        ]);
    }
}
