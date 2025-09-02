<?php

namespace App\Filament\Widgets;

use App\Models\StokBarang;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;

class ReportStokBarangTable extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Report Stok Barang';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(
                StokBarang::query()
            )
            ->columns([
                TextColumn::make('kode_barang')
                    ->label('Kode Barang')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('jenis_barang')
                    ->label('Jenis Barang')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('jumlah_stok')
                    ->label('Jumlah Stok')
                    ->sortable()
                    ->color(fn($record) => $record->jumlah_stok == 0 ? 'danger' : 'success'),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->getStateUsing(fn($record) => $record->jumlah_stok > 0 ? 'Ready' : 'Tidak Ready')
                    ->colors([
                        'success' => fn($state) => $state === 'Ready',
                        'danger' => fn($state) => $state === 'Tidak Ready',
                    ])
                    ->sortable(),
            ])
            ->defaultSort('jenis_barang');
    }
}
