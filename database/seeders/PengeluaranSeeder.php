<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PengeluaranSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'slug' => Str::slug('biaya listrik agustus'),
                'jenis_pengeluaran' => 'Biaya Listrik Bulanan',
                'tgl_pengeluaran' => '2025-08-05',
                'biaya' => 1500000,
                'bukti' => 'bukti_listrik.jpg',
                'keterangan' => 'Pembayaran PLN Agustus',
            ],
            [
                'slug' => Str::slug('biaya transport pengiriman'),
                'jenis_pengeluaran' => 'Transportasi Pengiriman',
                'tgl_pengeluaran' => '2025-08-06',
                'biaya' => 500000,
                'bukti' => 'bukti_transport.jpg',
                'keterangan' => 'Ongkos kirim ke toko grosir',
            ],
        ];

        foreach ($data as $item) {
            DB::table('pengeluaran')->updateOrInsert(
                ['slug' => $item['slug']],
                $item
            );
        }
    }
}
