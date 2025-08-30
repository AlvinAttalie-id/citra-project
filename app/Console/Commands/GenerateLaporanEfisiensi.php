<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\LaporanEfisiensiController;

class GenerateLaporanEfisiensi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Example: php artisan laporan:efisiensi 2025-01-01 2025-08-30
     *
     * @var string
     */
    protected $signature = 'laporan:efisiensi {startDate?} {endDate?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate laporan efisiensi gudang';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $start = $this->argument('startDate');
        $end = $this->argument('endDate');

        $laporan = (new LaporanEfisiensiController)->getLaporan($start, $end);

        $this->info("=== Laporan Efisiensi Gudang ===");
        $this->line("Periode: {$start} s/d {$end}");
        $this->line("Total Supply      : {$laporan['total_supply']}");
        $this->line("Total Keluar      : {$laporan['total_keluar']}");
        $this->line("Return Barang     : {$laporan['total_return']}");
        $this->line("Barang Rusak      : {$laporan['total_rusak']}");
        $this->line("Keluar Bersih     : {$laporan['total_keluar_bersih']}");
        $this->line("Efisiensi (%)     : {$laporan['efisiensi']} %");
        $this->line("Total Pengeluaran : Rp " . number_format($laporan['total_pengeluaran'], 0, ',', '.'));

        return Command::SUCCESS;
    }
}
