<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user Admin
        $admin = User::firstOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => bcrypt('password123'),
                'alamat' => 'Jl. Sistem Gudang No.1',
                'no_hp' => '081234567890',
                'role' => 'admin',
            ]
        );
        $admin->assignRole('admin');

        // Buat user Suplayer
        $suplayer = User::firstOrCreate(
            ['username' => 'suplayer1'],
            [
                'name' => 'Supplier Default',
                'email' => 'suplier@example.com',
                'password' => bcrypt('password123'),
                'alamat' => 'Jl. Suplai Barang No.2',
                'no_hp' => '089876543210',
                'role' => 'suplayer',
            ]
        );
        $suplayer->assignRole('suplayer');
    }
}
