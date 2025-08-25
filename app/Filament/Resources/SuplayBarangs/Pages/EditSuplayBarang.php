<?php

namespace App\Filament\Resources\SuplayBarangs\Pages;

use App\Filament\Resources\SuplayBarangs\SuplayBarangResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSuplayBarang extends EditRecord
{
    protected static string $resource = SuplayBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
