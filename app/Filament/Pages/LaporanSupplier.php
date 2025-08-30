<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\SuplayBarang;
use App\Models\BarangRusak;
use App\Models\ReturnBarang;
use App\Models\User;
use BackedEnum;
use UnitEnum;
use Filament\Support\Icons\Heroicon;

class LaporanSupplier extends Page
{
    protected static string|UnitEnum|null $navigationGroup = 'Report';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTruck;
    protected static ?string $title = 'Laporan Supplier Performance';
    protected string $view = 'filament.pages.laporan-supplier';

    public array $laporan = [];

    public function mount(): void
    {
        $this->laporan = $this->getLaporan();
    }

    private function getLaporan(): array
    {
        // Ambil user yang punya role suplayer
        $suppliers = User::role('suplayer')->get();

        $laporan = [];

        foreach ($suppliers as $supplier) {
            $totalSupply = SuplayBarang::where('id_user', $supplier->id_user)->sum('jumlah');
            $totalRusak  = BarangRusak::where('id_user', $supplier->id_user)->sum('jumlah_rusak');
            $totalReturn = ReturnBarang::where('id_user', $supplier->id_user)->sum('jumlah');


            $efisiensi = $totalSupply > 0
                ? round((($totalSupply - ($totalRusak + $totalReturn)) / $totalSupply) * 100, 2)
                : 0;

            $laporan[] = [
                'nama_supplier' => $supplier->name,
                'total_supply'  => $totalSupply,
                'total_rusak'   => $totalRusak,
                'total_return'  => $totalReturn,
                'efisiensi'     => $efisiensi,
            ];
        }

        return $laporan;
    }
}
