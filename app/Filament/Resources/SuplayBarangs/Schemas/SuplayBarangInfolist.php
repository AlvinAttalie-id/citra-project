<?php

namespace App\Filament\Resources\SuplayBarangs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SuplayBarangInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nomor_pengiriman'),
                TextEntry::make('id_user')
                    ->numeric(),
                TextEntry::make('kode_barang'),
                TextEntry::make('tgl_pengiriman')
                    ->date(),
                TextEntry::make('jumlah')
                    ->numeric(),
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
