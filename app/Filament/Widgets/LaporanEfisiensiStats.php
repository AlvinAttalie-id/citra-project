<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Http\Controllers\LaporanEfisiensiController;

class LaporanEfisiensiStats extends StatsOverviewWidget
{
    protected ?string $heading = 'Laporan Efisiensi Gudang';

    protected function getStats(): array
    {
        $laporan = (new LaporanEfisiensiController)->getLaporan();

        return [
            Stat::make('Total Barang Masuk', $laporan['total_supply']),
            Stat::make('Total Barang Keluar', $laporan['total_keluar']),
            Stat::make('Barang Return', $laporan['total_return']),
            Stat::make('Barang Rusak', $laporan['total_rusak']),
            Stat::make('Keluar Bersih', $laporan['total_keluar_bersih']),
            Stat::make('Efisiensi (%)', $laporan['efisiensi'] . ' %'),
            Stat::make('Total Pengeluaran', 'Rp ' . number_format($laporan['total_pengeluaran'], 0, ',', '.')),
        ];
    }
}
