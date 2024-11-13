<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminBannerController;
use App\Http\Controllers\Client\ClientCartController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminVariantController;
use App\Http\Controllers\Client\CilentOrderController;
use App\Http\Controllers\Client\ClientIndexController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Client\ClentProductController;
use App\Http\Controllers\Admin\AdminVariantListController;

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

Route::get('/',               [ClientIndexController::class, 'index'])->name('index');
Route::get('/shop',           [ClentProductController::class, 'index'])->name('shop');
Route::get('/detail/{id}',    [ClientIndexController::class, 'detail'])->name('detail');
// Route::get('/my-account', function () {
//     return view('clients.my-account');
// })->name('my-account');
Route::get('/contact', function () { return view('clients.contact'); })->name('contact');
Route::get('/about', function () { return view('clients.about'); })->name('about');
Auth::routes();
Route::middleware(['auth'])->prefix('cart')
->as('cart.')
->group(function () {
    Route::get('/list',         [ClientCartController::class, 'listCart'] )->name('list');
    Route::post('/add',         [ClientCartController::class, 'addCart'] )->name('add');
    Route::post('/update',      [ClientCartController::class, 'updateCart'] )->name('update');
    Route::post('/remove',      [ClientCartController::class, 'removeCart'] )->name('remove');
});
Route::middleware('auth')->prefix('orders')
            ->as('orders.')
            ->group(function () {
                Route::get('/',                [CilentOrderController::class, 'index'])->name('index');
                Route::get('/create',          [CilentOrderController::class, 'create'])->name('create');
                Route::post('/store',          [CilentOrderController::class, 'store'])->name('store');
                Route::get('/show/{id}',       [CilentOrderController::class, 'show'])->name('show');
                Route::put('/{id}/update',     [CilentOrderController::class, 'update'])->name('update');
            });
Route::post('/payment/momo',        [PaymentController::class, 'createPayment'])->name('payment.momo');
Route::get('/payment/momo-return',  [PaymentController::class, 'handleMomoReturn'])->name('payment.momo.return');

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
        Route::prefix('products')
            ->as('products.')
            ->group(function () {
                Route::get('/index',           [AdminProductController::class, 'index'])->name('index');
                Route::get('/create',          [AdminProductController::class, 'create'])->name('create');
                Route::post('/store',          [AdminProductController::class, 'store'])->name('store');
                Route::get('/show/{id}',       [AdminProductController::class, 'show'])->name('show');
                Route::get('/{id}/edit',       [AdminProductController::class, 'edit'])->name('edit');
                Route::put('/{id}/update',     [AdminProductController::class, 'update'])->name('update');
                Route::delete('/{id}/destroy', [AdminProductController::class, 'destroy'])->name('destroy');
            });
        Route::prefix('variantLists')
            ->as('variantLists.')
            ->group(function () {
                Route::get('/index',           [AdminVariantListController::class, 'index'])->name('index');
                Route::get('/create',          [AdminVariantListController::class, 'create'])->name('create');
                Route::post('/store',          [AdminVariantListController::class, 'store'])->name('store');
                Route::get('/show/{id}',       [AdminVariantListController::class, 'show'])->name('show');
                Route::get('/{id}/edit',       [AdminVariantListController::class, 'edit'])->name('edit');
                Route::put('/{id}/update',     [AdminVariantListController::class, 'update'])->name('update');
                Route::delete('/{id}/destroy', [AdminVariantListController::class, 'destroy'])->name('destroy');
            });
        Route::prefix('variants')
            ->as('variants.')
            ->group(function () {
                Route::get('/index',           [AdminVariantController::class, 'index'])->name('index');
                Route::get('/create',          [AdminVariantController::class, 'create'])->name('create');
                Route::post('/store',          [AdminVariantController::class, 'store'])->name('store');
                Route::get('/show/{id}',       [AdminVariantController::class, 'show'])->name('show');
                Route::get('/{id}/edit',       [AdminVariantController::class, 'edit'])->name('edit');
                Route::put('/{id}/update',     [AdminVariantController::class, 'update'])->name('update');
                Route::delete('/{id}/destroy', [AdminVariantController::class, 'destroy'])->name('destroy');
            });
    });
