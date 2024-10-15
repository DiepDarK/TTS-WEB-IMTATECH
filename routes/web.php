<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminBannerController;
use App\Http\Controllers\Admin\AdminCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('clients.index');
})->name('index');

Auth::routes();

// Route Admin
Route::middleware(['auth', 'auth.admin'])->prefix('admins')
    ->as('admins.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admins.dashboard');
        })->name('dashboard');
        Route::prefix('users')
            ->as('users.')
            ->group(function () {
                Route::get('/index',           [AdminUserController::class, 'index'])->name('index');
                Route::get('/create',          [AdminUserController::class, 'create'])->name('create');
                Route::post('/store',          [AdminUserController::class, 'store'])->name('store');
                Route::get('/show/{id}',       [AdminUserController::class, 'show'])->name('show');
                Route::get('/{id}/edit',       [AdminUserController::class, 'edit'])->name('edit');
                Route::put('/{id}/update',     [AdminUserController::class, 'update'])->name('update');
                Route::delete('/{id}/destroy', [AdminUserController::class, 'destroy'])->name('destroy');
            });
        Route::prefix('categories')
            ->as('categories.')
            ->group(function () {
                Route::get('/index',           [AdminCategoryController::class, 'index'])->name('index');
                Route::get('/create',          [AdminCategoryController::class, 'create'])->name('create');
                Route::post('/store',          [AdminCategoryController::class, 'store'])->name('store');
                Route::get('/show/{id}',       [AdminCategoryController::class, 'show'])->name('show');
                Route::get('/{id}/edit',       [AdminCategoryController::class, 'edit'])->name('edit');
                Route::put('/{id}/update',     [AdminCategoryController::class, 'update'])->name('update');
                Route::delete('/{id}/destroy', [AdminCategoryController::class, 'destroy'])->name('destroy');
            });
        Route::prefix('banners')
            ->as('banners.')
            ->group(function () {
                Route::get('/index',           [AdminBannerController::class, 'index'])->name('index');
                Route::get('/create',          [AdminBannerController::class, 'create'])->name('create');
                Route::post('/store',          [AdminBannerController::class, 'store'])->name('store');
                Route::get('/show/{id}',       [AdminBannerController::class, 'show'])->name('show');
                Route::get('/{id}/edit',       [AdminBannerController::class, 'edit'])->name('edit');
                Route::put('/{id}/update',     [AdminBannerController::class, 'update'])->name('update');
                Route::delete('/{id}/destroy', [AdminBannerController::class, 'destroy'])->name('destroy');
            });
    });
