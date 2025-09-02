<?php

namespace App\Filament\Widgets;

use App\Models\SuplayBarang;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;

class LaporanSuplayBarangTable extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';
    protected static ?string $heading = 'Laporan Suplay Barang';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(
                SuplayBarang::query()->with('user')
            )
            ->columns([
                TextColumn::make('nomor_pengiriman')
                    ->label('Nomor Pengiriman')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('Supplier')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('kode_barang')
                    ->label('Kode Barang')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('tgl_pengiriman')
                    ->label('Tanggal Pengiriman')
                    ->date()
                    ->sortable(),

                TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->numeric()
                    ->sortable()
                    ->summarize(Tables\Columns\Summarizers\Sum::make()),

                TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->searchable(),
            ])
            ->filters([
                Filter::make('tgl_pengiriman')
                    ->label('Tanggal Pengiriman')
                    ->form([
                        DatePicker::make('from')->label('Dari'),
                        DatePicker::make('until')->label('Sampai'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn($q, $date) => $q->whereDate('tgl_pengiriman', '>=', $date))
                            ->when($data['until'], fn($q, $date) => $q->whereDate('tgl_pengiriman', '<=', $date));
                    }),
            ])
            ->defaultSort('tgl_pengiriman', 'desc');
    }
}
