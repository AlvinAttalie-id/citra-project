<?php

namespace App\Filament\Pages;

use Filament\Actions\Action as ActionsAction;
use Filament\Pages\Page;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\LaporanSuplayBarangService;
use App\Filament\Widgets\LaporanSuplayBarangChart;
use App\Filament\Widgets\LaporanSuplayBarangTable;
use BackedEnum;
use UnitEnum;
use Filament\Support\Icons\Heroicon;

class LaporanSuplayBarang extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Report';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;
    protected static ?string $title = 'Laporan Suplay Barang';
    protected string $view = 'filament.pages.laporan-suplay-barang';

    protected function getHeaderWidgets(): array
    {
        return [
            LaporanSuplayBarangTable::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            ActionsAction::make('exportPdf')
                ->label('Cetak PDF')
                ->icon('heroicon-o-printer')
                ->action(function () {
                    $filters = $this->filters ?? [];

                    $laporan = LaporanSuplayBarangService::getLaporanDetail(
                        from: $filters['tgl_pengiriman']['from'] ?? null,
                        until: $filters['tgl_pengiriman']['until'] ?? null,
                        tahun: $filters['tahun'] ?? null,
                    );

                    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('reports.suplay-barang', [
                        'laporan' => $laporan,
                    ])->setPaper('a4', 'portrait');

                    return response()->streamDownload(
                        fn() => print($pdf->output()),
                        'laporan-suplay-barang.pdf'
                    );
                }),
        ];
    }
}
