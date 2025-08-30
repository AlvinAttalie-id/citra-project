<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Filament\Widgets\LaporanEfisiensiStats;
use BackedEnum;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class LaporanEfisiensi extends Page
{
    protected static string | UnitEnum | null $navigationGroup = 'Report';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;
    protected string $view = 'filament.pages.laporan-efisiensi';

    protected function getHeaderWidgets(): array
    {
        return [
            LaporanEfisiensiStats::class,
        ];
    }

    public function getHeaderWidgetsColumns(): int|array
    {
        return 2;
    }
}
