<?php

namespace App\Filament\Resources\Pengeluarans\Schemas;

use Filament\Schemas\Schema;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class PengeluaranInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([

                Section::make('INVOICE PENGELUARAN')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('slug')
                                ->label('No Invoice')
                                ->weight('bold')
                                ->size('lg'),

                            TextEntry::make('tgl_pengeluaran')
                                ->label('Tanggal')
                                ->date('d F Y'),

                            TextEntry::make('jenis_pengeluaran')
                                ->label('Jenis'),
                        ]),
                    ]),

                Section::make('Detail')
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('biaya')
                                ->money('IDR')
                                ->weight('bold')
                                ->size('lg'),

                            TextEntry::make('bukti'),
                        ]),
                    ]),

                Section::make('Keterangan')
                    ->schema([
                        TextEntry::make('keterangan')
                            ->columnSpanFull(),
                    ]),

                Section::make('Meta')
                    ->collapsed()
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('created_at')->dateTime(),
                            TextEntry::make('updated_at')->dateTime(),
                            TextEntry::make('deleted_at')->dateTime(),
                        ]),
                    ]),

            ]);
    }
}
