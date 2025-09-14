<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuplayBarang;
use App\Models\User;
use App\Models\StokBarang;
use Carbon\Carbon;

class SuplayBarangSeeder extends Seeder
{
    public function run(): void
    {
        $suplayer = User::where('role', 'suplayer')->inRandomOrder()->first();

        $stokList = StokBarang::take(5)->get();

        foreach ($stokList as $stok) {
            SuplayBarang::create([
                'id_user' => $suplayer->id_user,
                'kode_barang' => $stok->kode_barang,
                'tgl_pengiriman' => Carbon::now()->subDays(rand(1, 10)),
                'jumlah' => rand(10, 50),
                'keterangan' => 'Suplay awal dari ' . $suplayer->name,
            ]);
        }
    }
}
