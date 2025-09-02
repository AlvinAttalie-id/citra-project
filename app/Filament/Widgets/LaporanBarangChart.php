<?php

namespace App\Filament\Widgets;

use App\Models\SuplayBarang;
use App\Models\BarangKeluar;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class LaporanBarangChart extends ChartWidget
{
    protected ?string $heading = 'Laporan Barang Masuk vs Keluar';
    protected int|string|array $columnSpan = 'full';

    public ?string $filter = null;

    // Tambahkan mode (bulan/semester/tahun)
    public ?string $mode = 'semester';

    protected function getFilters(): ?array
    {
        $years = range(now()->year, now()->year - 5);

        return [
            'mode_bulan' => 'Per Bulan',
            'mode_semester' => 'Per Semester',
            'mode_tahun' => 'Per Tahun',
        ] + collect($years)
            ->mapWithKeys(fn($year) => [(string) $year => (string) $year])
            ->toArray();
    }

    protected function getData(): array
    {
        // Ambil tahun & mode dari filter
        $tahun = now()->year;
        $mode = 'semester';

        if ($this->filter) {
            if (str_starts_with($this->filter, 'mode_')) {
                $mode = str_replace('mode_', '', $this->filter);
            } else {
                $tahun = (int) $this->filter;
            }
        }

        $labels = [];
        $masukData = [];
        $keluarData = [];

        if ($mode === 'bulan') {
            // Per bulan
            $labels = range(1, 12);

            $masuk = SuplayBarang::select(DB::raw('MONTH(created_at) as bulan'), DB::raw('SUM(jumlah) as total'))
                ->whereYear('created_at', $tahun)
                ->groupBy('bulan')
                ->pluck('total', 'bulan');

            $keluar = BarangKeluar::select(DB::raw('MONTH(created_at) as bulan'), DB::raw('SUM(jumlah) as total'))
                ->whereYear('created_at', $tahun)
                ->groupBy('bulan')
                ->pluck('total', 'bulan');

            foreach ($labels as $bulan) {
                $masukData[] = (int) ($masuk[$bulan] ?? 0);
                $keluarData[] = (int) ($keluar[$bulan] ?? 0);
            }

            $labels = array_map(fn($b) => date("F", mktime(0, 0, 0, $b, 1)), $labels);
        } elseif ($mode === 'semester') {
            // Per semester
            $labels = ['Semester 1', 'Semester 2'];

            $masuk = SuplayBarang::select(
                DB::raw("CASE WHEN MONTH(created_at) BETWEEN 1 AND 6 THEN 'Semester 1' ELSE 'Semester 2' END as semester"),
                DB::raw('SUM(jumlah) as total')
            )
                ->whereYear('created_at', $tahun)
                ->groupBy('semester')
                ->pluck('total', 'semester');

            $keluar = BarangKeluar::select(
                DB::raw("CASE WHEN MONTH(created_at) BETWEEN 1 AND 6 THEN 'Semester 1' ELSE 'Semester 2' END as semester"),
                DB::raw('SUM(jumlah) as total')
            )
                ->whereYear('created_at', $tahun)
                ->groupBy('semester')
                ->pluck('total', 'semester');

            foreach ($labels as $semester) {
                $masukData[] = (int) ($masuk[$semester] ?? 0);
                $keluarData[] = (int) ($keluar[$semester] ?? 0);
            }
        } else {
            // Tahunan (5 tahun terakhir)
            $labels = range($tahun - 4, $tahun);

            $masuk = SuplayBarang::select(DB::raw('YEAR(created_at) as tahun'), DB::raw('SUM(jumlah) as total'))
                ->whereBetween(DB::raw('YEAR(created_at)'), [$tahun - 4, $tahun])
                ->groupBy('tahun')
                ->pluck('total', 'tahun');

            $keluar = BarangKeluar::select(DB::raw('YEAR(created_at) as tahun'), DB::raw('SUM(jumlah) as total'))
                ->whereBetween(DB::raw('YEAR(created_at)'), [$tahun - 4, $tahun])
                ->groupBy('tahun')
                ->pluck('total', 'tahun');

            foreach ($labels as $thn) {
                $masukData[] = (int) ($masuk[$thn] ?? 0);
                $keluarData[] = (int) ($keluar[$thn] ?? 0);
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Barang Masuk',
                    'data' => $masukData,
                    'backgroundColor' => 'rgba(75, 192, 192, 0.7)',
                ],
                [
                    'label' => 'Barang Keluar',
                    'data' => $keluarData,
                    'backgroundColor' => 'rgba(255, 99, 132, 0.7)',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
