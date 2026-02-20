<?php

namespace App\Filament\Resources\ReturnBarangs\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use App\Models\BarangKeluar;
use App\Models\User;
use Filament\Forms\Components\Hidden;

class ReturnBarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('id_user')
                    ->label('Pilih Suplayer')
                    ->options(
                        User::where('role', 'suplayer')
                            ->pluck('name', 'id_user')
                            ->toArray()
                    )
                    ->searchable()
                    ->required(),
                Select::make('id_keluar')
                    ->label('Barang Keluar')
                    ->options(function ($record) {
                        return BarangKeluar::with('stokBarang')
                            ->whereHas('stokBarang')
                            ->where(function ($query) use ($record) {
                                $query->where('status', 'process');

                                if ($record?->id_keluar) {
                                    $query->orWhere('id_keluar', $record->id_keluar);
                                }
                            })
                            ->get()
                            ->mapWithKeys(fn($item) => [
                                $item->id_keluar => $item->stokBarang->jenis_barang ?? '-'
                            ]);
                    })
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $barangKeluar = BarangKeluar::with('stokBarang')->find($state);
                        $set('id_barang', $barangKeluar?->stokBarang?->id_barang);
                    })
                    ->afterStateHydrated(function ($state, callable $set) {
                        if ($state) {
                            $barangKeluar = BarangKeluar::with('stokBarang')->find($state);
                            $set('id_barang', $barangKeluar?->stokBarang?->id_barang);
                        }
                    })
                    ->required(),
                Hidden::make('id_barang'),
                DatePicker::make('tanggal_r')
                    ->required(),
                TextInput::make('jumlah')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(
                        fn(Get $get) =>
                        BarangKeluar::find($get('id_keluar'))?->jumlah ?? 0
                    )
                    ->helperText(
                        fn(Get $get) =>
                        $get('id_keluar')
                            ? 'Maksimal return: ' . (BarangKeluar::find($get('id_keluar'))->jumlah ?? 0)
                            : 'Pilih barang keluar terlebih dahulu'
                    ),
                TextInput::make('alasan'),
            ]);
    }
}
