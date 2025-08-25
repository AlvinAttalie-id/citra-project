<?php

namespace App\Filament\Resources\ReturnBarangs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ReturnBarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('id_keluar')
                    ->required()
                    ->numeric(),
                TextInput::make('kode_barang')
                    ->required(),
                DatePicker::make('tanggal_r')
                    ->required(),
                TextInput::make('jumlah')
                    ->required()
                    ->numeric(),
                TextInput::make('alasan'),
            ]);
    }
}
