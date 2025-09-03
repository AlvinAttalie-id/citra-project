<?php

namespace App\Filament\Pages;

use Filament\Actions\Action as ActionsAction;
use Filament\Pages\Page;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\LaporanStokBarangService;
use App\Filament\Widgets\ReportStokBarangTable;
use BackedEnum;
use UnitEnum;
use Filament\Support\Icons\Heroicon;

class LaporanStokBarang extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Data Master';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;
    protected static ?string $title = 'Data Stok Barang';
    protected string $view = 'filament.pages.laporan-stok-barang';

    protected function getHeaderWidgets(): array
    {
        return [
            ReportStokBarangTable::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            ActionsAction::make('exportPdf')
                ->label('Cetak PDF')
                ->icon('heroicon-o-printer')
                ->action(function () {
                    $laporan = LaporanStokBarangService::getLaporan();

                    $pdf = Pdf::loadView('reports.stok-barang', compact('laporan'))
                        ->setPaper('a4', 'portrait');

                    return response()->streamDownload(
                        fn() => print($pdf->output()),
                        'laporan-stok-barang.pdf'
                    );
                }),
        ];
    }
}
