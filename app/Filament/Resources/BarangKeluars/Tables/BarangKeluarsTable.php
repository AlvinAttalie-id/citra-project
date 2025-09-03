<?php

namespace App\Filament\Resources\BarangKeluars\Tables;

use Filament\Actions\Action as ActionsAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Barryvdh\DomPDF\Facade\Pdf;

class BarangKeluarsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_barang')
                    ->searchable(),
                TextColumn::make('stokBarang.jenis_barang')
                    ->label('Jenis Barang')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('admin.name')
                    ->label('Dibuat Oleh')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('tgl_keluar')
                    ->date()
                    ->sortable(),
                TextColumn::make('jumlah')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('keterangan')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'process',
                        'success' => 'complete',
                        'info'    => 'return',
                    ])
                    ->sortable(),
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
                        return $query->whereMonth('tgl_keluar', '=', date('m', strtotime($data['tgl'])))
                            ->whereYear('tgl_keluar', '=', date('Y', strtotime($data['tgl'])));
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make()
                    ->visible(fn($record) => ! in_array($record->status, ['complete', 'return'])),
                ActionsAction::make('setComplete')
                    ->label('Set Complete')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn($record) => $record->status === 'process')
                    ->action(function ($record) {
                        $record->update(['status' => 'complete']);
                    }),
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

                        $totalKeluar = $records->sum('jumlah');
                        $totalReturn = $records->where('status', 'return')->sum('jumlah');

                        $pdf = Pdf::loadView('reports.laporan-barang-keluar', [
                            'records' => $records,
                            'totalKeluar' => $totalKeluar,
                            'totalReturn' => $totalReturn,
                        ]);

                        return response()->streamDownload(fn() => print($pdf->output()), 'laporan-barang-keluar.pdf');
                    }),
            ]);
    }
}
