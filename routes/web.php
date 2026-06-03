<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {

    Route::get(
        '/login',
        [AuthController::class, 'showLogin']
    )->name('login');

    Route::post(
        '/login',
        [AuthController::class, 'login']
    )->name('login.process');

});

Route::middleware('auth')->group(function () {

    Route::post(
        '/logout',
        [AuthController::class, 'logout']
    )->name('logout');

    Route::get('/dashboard', function () {
        return redirect()->route('inventaris.index');
    })->name('dashboard');

    Route::middleware('admin')->group(function () {

        Route::get(
            '/inventaris/create',
            [InventarisController::class, 'create']
        )->name('inventaris.create');

        Route::post(
            '/inventaris',
            [InventarisController::class, 'store']
        )->name('inventaris.store');

        Route::get(
            '/inventaris/{inventari}/edit',
            [InventarisController::class, 'edit']
        )->name('inventaris.edit');

        Route::put(
            '/inventaris/{inventari}',
            [InventarisController::class, 'update']
        )->name('inventaris.update');

        Route::delete(
            '/inventaris/{inventari}',
            [InventarisController::class, 'destroy']
        )->name('inventaris.destroy');

    });

    Route::resource(
        'inventaris',
        InventarisController::class
    )->only(['index', 'show']);

    Route::resource(
        'kategori',
        KategoriController::class
    )->middleware('admin');

    Route::post(
        '/kategori/quick-store',
        [KategoriController::class, 'quickStore']
    )->middleware('admin')
        ->name('kategori.quick-store');

});