<?php

namespace App\Filament\Widgets;

use App\Models\StokBarang;
use App\Models\BarangKeluar;
use App\Models\SuplayBarang;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class LaporanStokBarangChart extends ChartWidget
{
    protected ?string $heading = 'Laporan Stok Barang';
    protected int|string|array $columnSpan = 'full';

    // Default filter
    protected ?string $pollingInterval = null;

    protected function getFilters(): ?array
    {
        return [
            'bulan' => 'Per Bulan',
            'semester' => 'Per 6 Bulan',
            'tahun' => 'Per Tahun',
        ];
    }

    protected function getData(): array
    {
        $filter = $this->filter ?? 'bulan';
        $labels = [];
        $stokMasuk = [];
        $stokKeluar = [];

        if ($filter === 'bulan') {
            // Laporan per bulan (tahun berjalan)
            $data = StokBarang::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('SUM(jumlah_stok) as total_stok')
            )
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get();

            foreach (range(1, 12) as $bulan) {
                $labels[] = date("F", mktime(0, 0, 0, $bulan, 1));
                $stokMasuk[] = $data->firstWhere('bulan', $bulan)->total_stok ?? 0;
                // contoh keluar
                $stokKeluar[] = BarangKeluar::whereMonth('created_at', $bulan)->sum('jumlah') ?? 0;
            }
        }

        if ($filter === 'semester') {
            // Laporan per semester (6 bulan)
            $labels = ['Semester 1', 'Semester 2'];

            foreach ([1, 2] as $s) {
                $start = ($s == 1) ? 1 : 7;
                $end = ($s == 1) ? 6 : 12;

                $stokMasuk[] = StokBarang::whereBetween(DB::raw('MONTH(created_at)'), [$start, $end])->sum('jumlah_stok');
                $stokKeluar[] = BarangKeluar::whereBetween(DB::raw('MONTH(created_at)'), [$start, $end])->sum('jumlah');
            }
        }

        if ($filter === 'tahun') {
            // Laporan tahunan (5 tahun terakhir)
            $tahunSekarang = date('Y');
            $labels = range($tahunSekarang - 4, $tahunSekarang);

            foreach ($labels as $tahun) {
                $stokMasuk[] = StokBarang::whereYear('created_at', $tahun)->sum('jumlah_stok');
                $stokKeluar[] = BarangKeluar::whereYear('created_at', $tahun)->sum('jumlah');
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Stok Masuk',
                    'data' => $stokMasuk,
                    'borderColor' => '#36A2EB',
                    'backgroundColor' => 'rgba(54,162,235,0.5)',
                ],
                [
                    'label' => 'Stok Keluar',
                    'data' => $stokKeluar,
                    'borderColor' => '#FF6384',
                    'backgroundColor' => 'rgba(255,99,132,0.5)',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // bisa diganti 'line'
    }
}
