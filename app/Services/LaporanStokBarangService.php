<?php

namespace App\Services;

use App\Models\StokBarang;

class LaporanStokBarangService
{
    public static function getLaporan(): array
    {
        $stokBarang = StokBarang::all();

        $laporan = [];

        foreach ($stokBarang as $barang) {
            $laporan[] = [
                'kode_barang'  => $barang->kode_barang,
                'jenis_barang' => $barang->jenis_barang,
                'jumlah_stok'  => $barang->jumlah_stok,
                'harga'        => $barang->harga,
                'status'       => $barang->jumlah_stok > 11 ? 'Ready' : 'Tidak Ready',
            ];
        }

        return $laporan;
    }
}
