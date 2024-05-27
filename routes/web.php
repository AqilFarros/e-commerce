<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MyTransactionController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\TransactionController;

Route::get('/', [\App\Http\Controllers\FrontEnd\FrontEndController::class, 'index']);
Route::get('/detail-product/{slug}', [\App\Http\Controllers\FrontEnd\FrontEndController::class, 'detailProduct'])->name('detail.product');
Route::get('detail-category/{slug}', [\App\Http\Controllers\FrontEnd\FrontEndController::class, 'detailCategory'])->name('detail.category');

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/cart', [\App\Http\Controllers\FrontEnd\FrontEndController::class, 'cart'])->name('cart');
    Route::post('/add-to-cart/{id}', [\App\Http\Controllers\FrontEnd\FrontEndController::class, 'addToCart'])->name('add.cart');
    Route::delete('/cart/delete/{id}', [\App\Http\Controllers\FrontEnd\FrontEndController::class, 'deleteCart'])->name('delete.cart');
    Route::post('/checkout', [\App\Http\Controllers\FrontEnd\FrontEndController::class, 'checkOut'])->name('checkout');
});

Route::name('admin.')->prefix('admin')->middleware('admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/category', CategoryController::class)->except(['show', 'create', 'edit']);
    Route::resource('/product', ProductController::class);
    Route::resource('/product.gallery', ProductGalleryController::class)->except(['create', 'show', 'edit', 'update']);
    Route::resource('/transaction', TransactionController::class);
    Route::resource('/my-transaction', MyTransactionController::class)->only(['index']);
    Route::get('/my-transaction/{slug}/{id}', [MyTransactionController::class, 'showDataBySlugAndId'])->name('my-transaction.showDataBySlugAndId');
    Route::name('user.')->prefix('user')->group(function() {
        Route::get('/index', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('index');
        Route::put('reset-password/{id}', [\App\Http\Controllers\Admin\UserController::class, 'resetPassword'])->name('reset-password');
    });
});

Route::name('user.')->prefix('user')->middleware('user')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');
    Route::put('/change-password', [\App\Http\Controllers\User\DashboardController::class, 'changePassword'])->name('change-password');
    Route::resource('/my-transaction', MyTransactionController::class)->only(['index']);
    Route::get('/my-transaction/{slug}/{id}', [MyTransactionController::class, 'showDataBySlugAndId'])->name('my-transaction.showDataBySlugAndId');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
