<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReturnBarang;
use App\Models\BarangKeluar;
use App\Models\User;
use Carbon\Carbon;

class ReturnBarangSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        $keluar = BarangKeluar::inRandomOrder()->first();

        if ($keluar) {
            ReturnBarang::create([
                'id_keluar' => $keluar->id_keluar,
                'kode_barang' => $keluar->kode_barang,
                'tanggal_r' => Carbon::now(),
                'jumlah' => 1,
                'alasan' => 'Barang tidak sesuai',
                'id_user' => $admin->id_user,
            ]);
        }
    }
}
