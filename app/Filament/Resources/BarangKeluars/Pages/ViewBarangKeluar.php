<?php

namespace App\Filament\Resources\BarangKeluars\Pages;

use App\Filament\Resources\BarangKeluars\BarangKeluarResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBarangKeluar extends ViewRecord
{
    protected static string $resource = BarangKeluarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
