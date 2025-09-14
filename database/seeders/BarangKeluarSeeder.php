<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BarangKeluar;
use App\Models\StokBarang;
use App\Models\User;
use Carbon\Carbon;

class BarangKeluarSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user dengan id 2-4 (anggap mereka suplayer)
        $suplayers = User::where('role', 'suplayer')
            ->whereBetween('id_user', [2, 4])
            ->get();

        if ($suplayers->isEmpty()) {
            $this->command->warn('Seeder gagal: Tidak ada user dengan id_user 2-4 (suplayer).');
            return;
        }

        $stokList = StokBarang::take(10)->get();

        foreach ($stokList as $stok) {
            $suplayer = $suplayers->random();

            BarangKeluar::create([
                'kode_barang' => $stok->kode_barang,
                'id_user' => $suplayer->id_user,
                'tgl_keluar' => Carbon::now()->subDays(rand(1, 7)),
                'jumlah' => rand(1, 5),
                'keterangan' => 'Pengiriman order via ' . $suplayer->name,
                'status' => 'process',
            ]);
        }
    }
}
