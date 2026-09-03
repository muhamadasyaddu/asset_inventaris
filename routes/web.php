<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SupplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
|
| Logout menggunakan method POST + CSRF protection.
| Session pengguna akan di-invalidate setelah logout.
|
*/

Route::post('/logout', function (Request $request) {

    if (Auth::check()) {
        Auth::logout();
    }

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()
        ->route('dashboard')
        ->with('success', 'Anda telah keluar dari sistem.');

})->name('logout');


/*
|--------------------------------------------------------------------------
| Resource Routes - Manajemen Inventaris
|--------------------------------------------------------------------------
*/

Route::resource('categories', CategoryController::class);

Route::resource('suppliers', SupplierController::class);

Route::resource('locations', LocationController::class);

Route::resource('assets', AssetController::class);