<?php

namespace App\Filament\Pages;

use Filament\Actions\Action as ActionsAction;
use Filament\Pages\Page;
use Barryvdh\DomPDF\Facade\Pdf;
use BackedEnum;
use UnitEnum;
use Filament\Support\Icons\Heroicon;
use App\Filament\Widgets\LaporanPengeluaranChart;
use App\Services\LaporanPengeluaranService;

class LaporanPengeluaran extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Data Master';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;
    protected static ?string $title = 'Data Pengeluaran';
    protected string $view = 'filament.pages.laporan-pengeluaran';

    protected function getHeaderWidgets(): array
    {
        return [
            LaporanPengeluaranChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            ActionsAction::make('exportPdf')
                ->label('Cetak PDF')
                ->icon('heroicon-o-printer')
                ->action(function () {
                    $laporanSemester = LaporanPengeluaranService::getLaporan('semester');
                    $laporanTahunan  = LaporanPengeluaranService::getLaporan('tahun');

                    $pdf = Pdf::loadView('reports.laporan-pengeluaran-data', compact('laporanSemester', 'laporanTahunan'))
                        ->setPaper('a4', 'portrait');

                    return response()->streamDownload(
                        fn() => print($pdf->output()),
                        'laporan-pengeluaran.pdf'
                    );
                }),
        ];
    }
}
