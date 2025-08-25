<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReturnBarangSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'id_keluar' => 1, // refer ke barang keluar
                'kode_barang' => 'BRG001',
                'tanggal_r' => '2025-08-07',
                'jumlah' => 2,
                'alasan' => 'Kemasan rusak saat diterima',
            ],
        ];

        foreach ($data as $item) {
            DB::table('return_barang')->insertOrIgnore($item);
        }
    }
}
