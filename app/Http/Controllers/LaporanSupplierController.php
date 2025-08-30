<?php

namespace App\Http\Controllers;

use App\Models\SuplayBarang;
use App\Models\BarangRusak;
use App\Models\ReturnBarang;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanSupplierController extends Controller
{
    public function getLaporan()
    {
        // Group by supplier
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
                'supplier' => $supplier->name,
                'total_supply' => $totalSupply,
                'total_rusak' => $totalRusak,
                'total_return' => $totalReturn,
                'efisiensi' => $efisiensi,
            ];
        }

        return $laporan;
    }

    public function exportPdf()
    {
        $laporan = $this->getLaporan();

        $pdf = Pdf::loadView('reports.supplier-performance', compact('laporan'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('laporan-supplier-performance.pdf');
    }
}
