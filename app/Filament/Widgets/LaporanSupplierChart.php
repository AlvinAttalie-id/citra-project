<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\User;
use App\Models\SuplayBarang;
use App\Models\BarangRusak;
use App\Models\ReturnBarang;

class LaporanSupplierChart extends ChartWidget
{
    protected ?string $heading = 'Efisiensi Supplier';
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $suppliers = User::role('suplayer')->get();
        $labels = [];
        $efisiensi = [];

        foreach ($suppliers as $supplier) {
            $totalSupply = SuplayBarang::where('id_user', $supplier->id_user)->sum('jumlah');
            $totalRusak  = BarangRusak::where('id_user', $supplier->id_user)->sum('jumlah_rusak');
            $totalReturn = ReturnBarang::where('id_user', $supplier->id_user)->sum('jumlah');
            $rate = $totalSupply > 0
                ? round((($totalSupply - ($totalRusak + $totalReturn)) / $totalSupply) * 100, 2)
                : 0;

            $labels[] = $supplier->name;
            $efisiensi[] = $rate;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Efisiensi (%)',
                    'data' => $efisiensi,
                    'backgroundColor' => '#3b82f6',
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
