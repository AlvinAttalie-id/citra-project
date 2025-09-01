<?php

namespace App\Filament\Pages;

use Filament\Actions\Action as ActionsAction;
use Filament\Pages\Page;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\SuplayBarang;
use App\Models\BarangRusak;
use App\Models\ReturnBarang;
use App\Models\User;
use BackedEnum;
use UnitEnum;
use Filament\Support\Icons\Heroicon;
use App\Filament\Widgets\LaporanSupplierChart;
use App\Services\LaporanSupplierService;

class LaporanSupplier extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Report';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTruck;
    protected static ?string $title = 'Laporan Supplier Performance';
    protected string $view = 'filament.pages.laporan-supplier';

    protected function getHeaderWidgets(): array
    {
        return [
            LaporanSupplierChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            ActionsAction::make('exportPdf')
                ->label('Cetak PDF')
                ->icon('heroicon-o-printer')
                ->action(function () {
                    $laporan = LaporanSupplierService::getLaporan();

                    $pdf = Pdf::loadView('reports.supplier-performance', compact('laporan'))
                        ->setPaper('a4', 'portrait');

                    return response()->streamDownload(
                        fn() => print($pdf->output()),
                        'laporan-supplier-performance.pdf'
                    );
                }),
        ];
    }
}
