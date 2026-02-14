<?php

namespace App\Filament\Resources\Pengeluarans\Pages;

use App\Filament\Resources\Pengeluarans\PengeluaranResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;
use Barryvdh\DomPDF\Facade\Pdf;

class ViewPengeluaran extends ViewRecord
{
    protected static string $resource = PengeluaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            Action::make('pdf')
            ->label('Export PDF')
            ->icon('heroicon-o-arrow-down-tray')
            ->action(function () {

                $record = $this->record;

                $pdf = Pdf::loadView('reports.pengeluaran-invoice', [
                    'record' => $record,
                ]);

                return response()->streamDownload(
                    fn () => print($pdf->output()),
                    'invoice-pengeluaran-'.$record->slug.'.pdf'
                );
            }),
        ];
    }
}
