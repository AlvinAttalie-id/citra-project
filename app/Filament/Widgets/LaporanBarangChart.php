<?php

namespace App\Filament\Widgets;

use App\Models\StokBarang;
use Filament\Widgets\ChartWidget;

class LaporanBarangChart extends ChartWidget
{
    protected ?string $heading = 'Laporan Barang Masuk vs Keluar';
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = StokBarang::withSum('suplayBarang as total_masuk', 'jumlah')
            ->withSum('barangKeluar as total_keluar', 'jumlah')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Barang Masuk',
                    'data' => $data->pluck('total_masuk')->map(fn($val) => (int) $val)->toArray(),
                    'backgroundColor' => 'rgba(75, 192, 192, 0.7)',
                ],
                [
                    'label' => 'Barang Keluar',
                    'data' => $data->pluck('total_keluar')->map(fn($val) => (int) $val)->toArray(),
                    'backgroundColor' => 'rgba(255, 99, 132, 0.7)',
                ],
            ],
            'labels' => $data->pluck('jenis_barang')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
