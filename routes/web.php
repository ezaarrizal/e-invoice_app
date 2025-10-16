<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| File ini sudah disesuaikan agar:
| - Login dan register (Breeze) aktif
| - Semua route invoice & item hanya bisa diakses setelah login
| - URL utama (/) tetap redirect ke halaman invoices
|--------------------------------------------------------------------------
*/

// ✅ Redirect ke halaman login jika belum login
Route::get('/', function () {
    return redirect()->route('login');
});

// ✅ Semua route berikut hanya bisa diakses jika user sudah login
Route::middleware(['auth'])->group(function () {

    // Redirect setelah login menuju halaman invoices
    Route::get('/dashboard', function () {
        return redirect()->route('invoices.index');
    })->name('dashboard');

    // CRUD Item
    Route::resource('items', ItemController::class);

    // CRUD Invoice + download PDF
    Route::get('/invoices/{id}/pdf', [InvoiceController::class, 'downloadPdf'])->name('invoices.download');
    Route::resource('invoices', InvoiceController::class);
});

// ✅ Route bawaan Breeze (login, register, logout)
require __DIR__.'/auth.php';

