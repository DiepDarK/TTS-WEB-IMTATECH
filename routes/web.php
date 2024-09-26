<?php

use App\Http\Controllers\Admin\AdminBannerController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use PHPUnit\Framework\Attributes\Group;

Route::get('/home', function () {
    return view('clients.index');
});


// Route Auth
Auth::routes();

// Route Admin
Route::middleware(['auth'])->prefix('admins')
->as('admins.')
->group(function () {
    Route::get('/dashboard', function (){
        return view('admins.dashboard');
    })->name('dashboard');
    Route::prefix('users')
    ->as('users.')
    ->group(function (){
        Route::get('/create',                  [AdminUserController::class, 'create'])->name('create');
                Route::post('/store',          [AdminUserController::class, 'store'])->name('store');
                Route::get('/show/{id}',       [AdminUserController::class, 'show'])->name('show');
                Route::get('/{id}/edit',       [AdminUserController::class, 'edit'])->name('edit');
                Route::put('/{id}/update',     [AdminUserController::class, 'update'])->name('update');
                Route::delete('/{id}/destroy', [AdminUserController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('categories')
    ->as('categories.')
    ->group(function (){
        Route::get('/',                        [AdminCategoryController::class, 'index'])->name('index');
                Route::get('/create',          [AdminCategoryController::class, 'create'])->name('create');
                Route::post('/store',          [AdminCategoryController::class, 'store'])->name('store');
                Route::get('/show/{id}',       [AdminCategoryController::class, 'show'])->name('show');
                Route::get('/{id}/edit',       [AdminCategoryController::class, 'edit'])->name('edit');
                Route::put('/{id}/update',     [AdminCategoryController::class, 'update'])->name('update');
                Route::delete('/{id}/destroy', [AdminCategoryController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('banners')
    ->as('banners.')
    ->group(function (){
        Route::get('/',                        [AdminBannerController::class, 'index'])->name('index');
                Route::get('/create',          [AdminBannerController::class, 'create'])->name('create');
                Route::post('/store',          [AdminBannerController::class, 'store'])->name('store');
                Route::get('/show/{id}',       [AdminBannerController::class, 'show'])->name('show');
                Route::get('/{id}/edit',       [AdminBannerController::class, 'edit'])->name('edit');
                Route::put('/{id}/update',     [AdminBannerController::class, 'update'])->name('update');
                Route::delete('/{id}/destroy', [AdminBannerController::class, 'destroy'])->name('destroy');
    });
});