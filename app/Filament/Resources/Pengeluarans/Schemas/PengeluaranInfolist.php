<?php

namespace App\Filament\Resources\Pengeluarans\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PengeluaranInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('slug'),
                TextEntry::make('jenis_pengeluaran'),
                TextEntry::make('tgl_pengeluaran')
                    ->date(),
                TextEntry::make('biaya')
                    ->numeric(),
                TextEntry::make('bukti'),
                TextEntry::make('keterangan'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('deleted_at')
                    ->dateTime(),
            ]);
    }
}
