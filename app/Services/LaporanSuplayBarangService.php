<?php

namespace App\Services;

use App\Models\SuplayBarang;
use Illuminate\Support\Facades\DB;

class LaporanSuplayBarangService
{
    /**
     * Ambil data untuk chart (default per bulan).
     */
    public static function getLaporan(
        string $mode = 'bulan',
        ?int $tahun = null,
        ?string $from = null,
        ?string $until = null
    ): array {
        $query = SuplayBarang::query();

        if ($from) {
            $query->whereDate('tgl_pengiriman', '>=', $from);
        }
        if ($until) {
            $query->whereDate('tgl_pengiriman', '<=', $until);
        }
        if ($tahun) {
            $query->whereYear('tgl_pengiriman', $tahun);
        }

        // Default grouping per bulan
        $labels = range(1, 12);
        $result = $query->select(
            DB::raw('MONTH(tgl_pengiriman) as bulan'),
            DB::raw('SUM(jumlah) as total')
        )
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $data = [];
        foreach ($labels as $bulan) {
            $data[] = (int) ($result[$bulan] ?? 0);
        }

        $labels = array_map(
            fn($b) => date("F", mktime(0, 0, 0, $b, 1)),
            $labels
        );

        return [
            'labels' => $labels,
            'data'   => $data,
            'tahun'  => $tahun ?? now()->year,
            'from'   => $from,
            'until'  => $until,
            'mode'   => $mode,
        ];
    }

    /**
     * Ambil data detail untuk tabel / PDF report.
     */
    public static function getLaporanDetail(
        ?string $from = null,
        ?string $until = null,
        ?int $tahun = null
    ) {
        return SuplayBarang::query()
            ->with('user')
            ->when($from, fn($q) => $q->whereDate('tgl_pengiriman', '>=', $from))
            ->when($until, fn($q) => $q->whereDate('tgl_pengiriman', '<=', $until))
            ->when($tahun, fn($q) => $q->whereYear('tgl_pengiriman', $tahun))
            ->orderBy('tgl_pengiriman', 'desc')
            ->get();
    }
}
