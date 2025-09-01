<?php

namespace App\Services;

use App\Models\StokBarang;

class LaporanBarangService
{
    public static function getLaporan()
    {
        return StokBarang::withSum('suplayBarang as total_masuk', 'jumlah')
            ->withSum('barangKeluar as total_keluar', 'jumlah')
            ->get()
            ->map(function ($item) {
                return [
                    'kode_barang'  => $item->kode_barang,
                    'jenis_barang' => $item->jenis_barang,
                    'total_masuk'  => $item->total_masuk ?? 0,
                    'total_keluar' => $item->total_keluar ?? 0,
                    'selisih'      => ($item->total_masuk ?? 0) - ($item->total_keluar ?? 0),
                ];
            });
    }
}
