<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Services\LaporanPengeluaranService;

class LaporanPengeluaranChart extends ChartWidget
{
    protected ?string $heading = 'Grafik Pengeluaran';
    protected int | string | array $columnSpan = 'full';

    /**
     * Definisikan filter di widget
     */
    protected function getFilters(): ?array
    {
        return [
            'tahun' => 'Per Tahun',
            'semester' => 'Per Semester',
        ];
    }

    /**
     * Ambil data chart sesuai filter
     */
    protected function getData(): array
    {
        // Default filter = 'tahun'
        $filter = $this->filter ?? 'tahun';

        $data = LaporanPengeluaranService::getLaporan($filter);

        if ($filter === 'tahun') {
            return [
                'datasets' => [
                    [
                        'label' => 'Total Pengeluaran',
                        'data' => collect($data)->pluck('total_biaya'),
                    ],
                ],
                'labels' => collect($data)->pluck('tahun'),
            ];
        }

        if ($filter === 'semester') {
            return [
                'datasets' => [
                    [
                        'label' => 'Total Pengeluaran',
                        'data' => collect($data)->pluck('total_biaya'),
                    ],
                ],
                'labels' => collect($data)->map(fn($row) => $row['tahun'] . ' ' . $row['semester']),
            ];
        }

        return [];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
