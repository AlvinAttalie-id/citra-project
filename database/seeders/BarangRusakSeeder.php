<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangRusakSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode_barang' => 'BRG003',
                'jumlah_rusak' => 5,
                'tanggal' => '2025-08-10',
                'keterangan' => 'Kemasannya sobek di gudang',
            ],
            [
                'kode_barang' => 'BRG004',
                'jumlah_rusak' => 3,
                'tanggal' => '2025-08-11',
                'keterangan' => 'Kelembapan menyebabkan rusak',
            ],
        ];

        foreach ($data as $item) {
            DB::table('barang_rusak')->insertOrIgnore($item);
        }
    }
}
