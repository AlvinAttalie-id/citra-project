<?php

namespace App\Filament\Pages;

use Filament\Actions\Action as ActionsAction;
use Filament\Pages\Page;
use Barryvdh\DomPDF\Facade\Pdf;
use BackedEnum;
use UnitEnum;
use Filament\Support\Icons\Heroicon;
use App\Filament\Widgets\LaporanEfisiensiStats;
use App\Services\LaporanEfisiensiService;

class LaporanEfisiensi extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Data Master';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;
    protected static ?string $title = 'Data Efisiensi Gudang';
    protected string $view = 'filament.pages.laporan-efisiensi';

    protected function getHeaderWidgets(): array
    {
        return [
            LaporanEfisiensiStats::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            ActionsAction::make('exportPdf')
                ->label('Cetak PDF')
                ->icon('heroicon-o-printer')
                ->action(function () {
                    $laporan = LaporanEfisiensiService::getLaporan();

                    $pdf = Pdf::loadView('reports.laporan-efisiensi', compact('laporan'))
                        ->setPaper('a4', 'portrait');

                    return response()->streamDownload(
                        fn() => print($pdf->output()),
                        'laporan-efisiensi.pdf'
                    );
                }),
        ];
    }
}
