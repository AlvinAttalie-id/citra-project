<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class StokBarangSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode_barang' => 'BRG001',
                'slug' => Str::slug('beras premium 5kg'),
                'jenis_barang' => 'Beras Premium 5Kg',
                'jumlah_stok' => 120,
                'harga' => 65000,
            ],
            [
                'kode_barang' => 'BRG002',
                'slug' => Str::slug('minyak goreng 1 liter'),
                'jenis_barang' => 'Minyak Goreng 1 Liter',
                'jumlah_stok' => 250,
                'harga' => 18000,
            ],
            [
                'kode_barang' => 'BRG003',
                'slug' => Str::slug('gula pasir 1kg'),
                'jenis_barang' => 'Gula Pasir 1Kg',
                'jumlah_stok' => 200,
                'harga' => 15000,
            ],
            [
                'kode_barang' => 'BRG004',
                'slug' => Str::slug('kopi bubuk 200gr'),
                'jenis_barang' => 'Kopi Bubuk 200gr',
                'jumlah_stok' => 80,
                'harga' => 22000,
            ],
            [
                'kode_barang' => 'BRG005',
                'slug' => Str::slug('susu kental manis'),
                'jenis_barang' => 'Susu Kental Manis 370gr',
                'jumlah_stok' => 150,
                'harga' => 12000,
            ],
        ];

        foreach ($data as $item) {
            DB::table('stok_barang')->updateOrInsert(
                ['kode_barang' => $item['kode_barang']],
                $item
            );
        }
    }
}
