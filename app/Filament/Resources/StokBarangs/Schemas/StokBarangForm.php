<?php

namespace App\Filament\Resources\StokBarangs\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class StokBarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('jenis_barang')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('jumlah_stok')
                    ->required()
                    ->numeric(),
                TextInput::make('harga')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
