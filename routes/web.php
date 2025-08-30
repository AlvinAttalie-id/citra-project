<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanSupplierController;


Route::get('/laporan-supplier', [LaporanSupplierController::class, 'index'])->name('laporan-supplier.index');
Route::get('/laporan-supplier/pdf', [LaporanSupplierController::class, 'exportPdf'])->name('laporan-supplier.pdf');

Route::get('/', function () {
    return view('welcome');
});
