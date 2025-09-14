<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
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

        $suplayers = [
            ['username' => 'jne', 'name' => 'JNE Express', 'email' => 'jne@example.com'],
            ['username' => 'jnt', 'name' => 'J&T Express', 'email' => 'jnt@example.com'],
            ['username' => 'sicepat', 'name' => 'SiCepat Ekspres', 'email' => 'sicepat@example.com'],
        ];

        foreach ($suplayers as $sp) {
            $user = User::firstOrCreate(
                ['username' => $sp['username']],
                [
                    'name' => $sp['name'],
                    'email' => $sp['email'],
                    'password' => bcrypt('password123'),
                    'alamat' => 'Jl. Gudang Besar No.99',
                    'no_hp' => '0812345678',
                    'role' => 'suplayer',
                ]
            );
            $user->assignRole('suplayer');
        }
    }
}
