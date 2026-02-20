<?php

namespace App\Filament\Resources\ReturnBarangs\Pages;

use App\Filament\Resources\ReturnBarangs\ReturnBarangResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewReturnBarang extends ViewRecord
{
    protected static string $resource = ReturnBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
