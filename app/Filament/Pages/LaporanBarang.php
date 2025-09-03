<?php

namespace App\Filament\Pages;

use Filament\Actions\Action as ActionsAction;
use Filament\Pages\Page;
use Barryvdh\DomPDF\Facade\Pdf;
use BackedEnum;
use UnitEnum;
use Filament\Support\Icons\Heroicon;
use App\Filament\Widgets\LaporanBarangChart;
use App\Services\LaporanBarangService;

class LaporanBarang extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Data Master';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTruck;
    protected static ?string $title = 'Data Barang Masuk dan Keluar';
    protected string $view = 'filament.pages.laporan-barang';

    protected function getHeaderWidgets(): array
    {
        return [
            LaporanBarangChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            ActionsAction::make('exportPdf')
                ->label('Cetak PDF')
                ->icon('heroicon-o-printer')
                ->action(function () {
                    $laporan = LaporanBarangService::getLaporan();

                    $pdf = Pdf::loadView('reports.laporan-barang', compact('laporan'))
                        ->setPaper('a4', 'portrait');

                    return response()->streamDownload(
                        fn() => print($pdf->output()),
                        'laporan-barang.pdf'
                    );
                }),
        ];
    }
}
