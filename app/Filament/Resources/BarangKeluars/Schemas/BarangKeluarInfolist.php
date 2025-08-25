<?php

namespace App\Filament\Resources\BarangKeluars\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BarangKeluarInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('kode_barang'),
                TextEntry::make('id_user')
                    ->numeric(),
                TextEntry::make('tgl_keluar')
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
