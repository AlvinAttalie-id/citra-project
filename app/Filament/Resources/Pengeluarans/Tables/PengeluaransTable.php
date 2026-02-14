<?php

namespace App\Filament\Resources\Pengeluarans\Tables;

use Filament\Actions\Action as ActionsAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Barryvdh\DomPDF\Facade\Pdf;

class PengeluaransTable
{
    public static function configure(Table $table): Table
    {
        return $table
         ->defaultSort('tgl_pengeluaran', 'desc')
            ->columns([
                TextColumn::make('slug')
                    ->label('Kode Pengeluaran')
                    ->searchable(),
                TextColumn::make('jenis_pengeluaran')
                    ->searchable(),
                TextColumn::make('tgl_pengeluaran')
                    ->date()
                    ->sortable(),
                TextColumn::make('biaya')
                    ->numeric()
                    ->sortable()
                    ->money('IDR', true),
                TextColumn::make('bukti')
                    ->searchable(),
                TextColumn::make('keterangan')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
                Filter::make('bulan')
                    ->form([
                        DatePicker::make('tgl')
                            ->label('Pilih Bulan')
                            ->displayFormat('F Y')
                            ->native(false)
                            ->required(),
                    ])
                    ->query(function (Builder $query, array $data) {
                        if (! $data['tgl']) {
                            return $query;
                        }
                        return $query->whereMonth('tgl_pengeluaran', '=', date('m', strtotime($data['tgl'])))
                            ->whereYear('tgl_pengeluaran', '=', date('Y', strtotime($data['tgl'])));
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
                ActionsAction::make('export_pdf')
                    ->label('Export PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function ($data, $livewire) {
                        $records = $livewire->getFilteredTableQuery()->get();

                        $totalBiaya = $records->sum('biaya');

                        $pdf = Pdf::loadView('reports.laporan-pengeluaran', [
                            'records' => $records,
                            'totalBiaya' => $totalBiaya,
                        ]);

                        return response()->streamDownload(fn() => print($pdf->output()), 'laporan-pengeluaran.pdf');
                    }),
            ]);
    }
}
