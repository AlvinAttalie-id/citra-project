<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuplayBarang;
use App\Models\BarangKeluar;
use App\Models\BarangRusak;
use App\Models\ReturnBarang;
use App\Models\Pengeluaran;

class LaporanEfisiensiController extends Controller
{
    public function getLaporan($startDate = null, $endDate = null)
    {
        $supply = SuplayBarang::when(
            $startDate && $endDate,
            fn($q) =>
            $q->whereBetween('tgl_pengiriman', [$startDate, $endDate])
        )->sum('jumlah');

        $keluar = BarangKeluar::when(
            $startDate && $endDate,
            fn($q) =>
            $q->whereBetween('tgl_keluar', [$startDate, $endDate])
        )->sum('jumlah');

        $rusak = BarangRusak::when(
            $startDate && $endDate,
            fn($q) =>
            $q->whereBetween('tanggal', [$startDate, $endDate])
        )->sum('jumlah_rusak');

        $return = ReturnBarang::when(
            $startDate && $endDate,
            fn($q) =>
            $q->whereBetween('tanggal_r', [$startDate, $endDate])
        )->sum('jumlah');

        $biaya = Pengeluaran::when(
            $startDate && $endDate,
            fn($q) =>
            $q->whereBetween('tgl_pengeluaran', [$startDate, $endDate])
        )->sum('biaya');

        $keluarBersih = $keluar - ($rusak + $return);
        if ($keluarBersih < 0) $keluarBersih = 0;

        $efisiensi = $supply > 0 ? round(($keluarBersih / $supply) * 100, 2) : 0;

        return [
            'total_supply' => $supply,
            'total_keluar' => $keluar,
            'total_return' => $return,
            'total_rusak' => $rusak,
            'total_keluar_bersih' => $keluarBersih,
            'efisiensi' => $efisiensi,
            'total_pengeluaran' => $biaya,
        ];
    }
}
