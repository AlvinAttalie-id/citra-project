<?php

namespace App\Filament\Widgets;

use App\Models\SuplayBarang;
use App\Models\BarangKeluar;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class LaporanBarangChart extends ChartWidget
{
    protected ?string $heading = 'Laporan Barang Masuk vs Keluar (Per Semester)';
    protected int | string | array $columnSpan = 'full';

    // Default filter tahun = tahun sekarang
    public ?string $filter = null;

    protected function getFilters(): ?array
    {
        $years = range(now()->year, now()->year - 5); // 5 tahun terakhir
        return collect($years)
            ->mapWithKeys(fn($year) => [$year => (string) $year])
            ->toArray();
    }

    protected function getData(): array
    {
        $tahun = $this->filter ?? now()->year;

        // Barang Masuk
        $masuk = SuplayBarang::select(
            DB::raw("CASE
                            WHEN MONTH(created_at) BETWEEN 1 AND 6 THEN 'Semester 1'
                            ELSE 'Semester 2'
                        END as semester"),
            DB::raw('SUM(jumlah) as total_masuk')
        )
            ->whereYear('created_at', $tahun)
            ->groupBy('semester')
            ->pluck('total_masuk', 'semester');

        // Barang Keluar
        $keluar = BarangKeluar::select(
            DB::raw("CASE
                            WHEN MONTH(created_at) BETWEEN 1 AND 6 THEN 'Semester 1'
                            ELSE 'Semester 2'
                        END as semester"),
            DB::raw('SUM(jumlah) as total_keluar')
        )
            ->whereYear('created_at', $tahun)
            ->groupBy('semester')
            ->pluck('total_keluar', 'semester');

        $labels = ['Semester 1', 'Semester 2'];

        return [
            'datasets' => [
                [
                    'label' => 'Barang Masuk',
                    'data' => array_map(fn($s) => (int) ($masuk[$s] ?? 0), $labels),
                    'backgroundColor' => 'rgba(75, 192, 192, 0.7)',
                ],
                [
                    'label' => 'Barang Keluar',
                    'data' => array_map(fn($s) => (int) ($keluar[$s] ?? 0), $labels),
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
