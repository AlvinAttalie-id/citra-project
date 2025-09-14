<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BarangKeluarSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'slug' => Str::slug('penjualan beras agustus'),
                'kode_barang' => 'BRG001',
                'id_user' => 1,
                'tgl_keluar' => '2025-08-05',
                'jumlah' => 20,
                'keterangan' => 'Penjualan ke toko grosir A',
            ],
            [
                'slug' => Str::slug('penjualan minyak goreng agustus'),
                'kode_barang' => 'BRG002',
                'id_user' => 1,
                'tgl_keluar' => '2025-08-06',
                'jumlah' => 30,
                'keterangan' => 'Penjualan ke koperasi karyawan',
            ],
        ];

        foreach ($data as $item) {
            DB::table('barang_keluar')->updateOrInsert(
                ['slug' => $item['slug']],
                $item
            );
        }
    }
}
