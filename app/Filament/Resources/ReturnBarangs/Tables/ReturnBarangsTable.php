<?php

namespace App\Filament\Resources\ReturnBarangs\Tables;

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

class ReturnBarangsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_barang')
                    ->searchable(),
                TextColumn::make('kode_return')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Suplayer')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('tanggal_r')
                    ->date()
                    ->sortable(),
                TextColumn::make('jumlah')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('alasan')
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
                        return $query->whereMonth('tanggal_r', '=', date('m', strtotime($data['tgl'])))
                            ->whereYear('tanggal_r', '=', date('Y', strtotime($data['tgl'])));
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
                    ->action(function (array $data, $livewire) {
                        $records = $livewire->getFilteredTableQuery()->get();

                        $totalReturn = $records->sum('jumlah');

                        $pdf = Pdf::loadView('reports.laporan-return-barang', [
                            'records' => $records,
                            'totalReturn' => $totalReturn,
                        ]);

                        return response()->streamDownload(fn() => print($pdf->output()), 'laporan-return-barang.pdf');
                    }),
            ]);
    }
}
