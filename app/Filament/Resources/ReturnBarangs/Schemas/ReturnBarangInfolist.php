<?php

namespace App\Filament\Resources\ReturnBarangs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ReturnBarangInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('kode_barang'),
                TextEntry::make('tanggal_r')
                    ->date(),
                TextEntry::make('jumlah')
                    ->numeric(),
                TextEntry::make('alasan'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('deleted_at')
                    ->dateTime(),
            ]);
    }
}
