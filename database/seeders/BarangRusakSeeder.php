<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BarangRusak;
use App\Models\StokBarang;
use App\Models\User;
use Carbon\Carbon;

class BarangRusakSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        $stok = StokBarang::inRandomOrder()->first();

        BarangRusak::create([
            'kode_barang' => $stok->kode_barang,
            'jumlah_rusak' => 2,
            'tanggal' => Carbon::now(),
            'keterangan' => 'Kemasan bocor saat pengiriman',
            'id_user' => $admin->id_user,
        ]);
    }
}
