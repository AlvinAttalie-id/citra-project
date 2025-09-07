<?php

namespace App\Services;

use App\Models\Pengeluaran;
use Illuminate\Support\Facades\DB;

class LaporanPengeluaranService
{
    public static function getLaporan(string $mode = 'semester'): array
    {
        $query = Pengeluaran::query();

        if ($mode === 'semester') {
            return $query
                ->select(
                    DB::raw("YEAR(tgl_pengeluaran) as tahun"),
                    DB::raw("CASE
                        WHEN MONTH(tgl_pengeluaran) BETWEEN 1 AND 6 THEN 'Semester 1'
                        ELSE 'Semester 2' END as semester"),
                    DB::raw("SUM(biaya) as total_biaya")
                )
                ->groupBy('tahun', 'semester')
                ->orderBy('tahun', 'desc')
                ->get()
                ->toArray();
        }

        if ($mode === 'tahun') {
            return $query
                ->select(
                    DB::raw("YEAR(tgl_pengeluaran) as tahun"),
                    DB::raw("SUM(biaya) as total_biaya")
                )
                ->groupBy('tahun')
                ->orderBy('tahun', 'desc')
                ->get()
                ->toArray();
        }

        return [];
    }
}
