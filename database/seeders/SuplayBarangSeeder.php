<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SuplayBarangSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nomor_pengiriman' => 'SPY-001',
                'slug' => Str::slug('suplay beras premium 5kg'),
                'id_user' => 2, // id user suplayer
                'kode_barang' => 'BRG001',
                'tgl_pengiriman' => '2025-08-01',
                'jumlah' => 50,
                'keterangan' => 'Pengiriman rutin mingguan',
            ],
            [
                'nomor_pengiriman' => 'SPY-002',
                'slug' => Str::slug('suplay minyak goreng 1 liter'),
                'id_user' => 2,
                'kode_barang' => 'BRG002',
                'tgl_pengiriman' => '2025-08-02',
                'jumlah' => 100,
                'keterangan' => 'Promo penambahan stok',
            ],
        ];

        foreach ($data as $item) {
            DB::table('suplay_barang')->updateOrInsert(
                ['nomor_pengiriman' => $item['nomor_pengiriman']],
                $item
            );
        }
    }
}
