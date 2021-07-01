<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminProfile;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('profile', [AdminProfile::class, 'index'])->name('admin.profile')->middleware(['auth','verified', 'is.active']);

Route::group(['middleware' => ['auth','verified', 'is.active', 'is.establishment.updated']], function () {

    Route::get('', [HomeController::class, 'index'])->name('admin.index');

    Route::resource('clients', ClientController::class)->only(['index'])->names('admin.clients');

    Route::resource('products', ProductController::class)->only(['index'])->names('admin.products');

    Route::resource('tables', TableController::class)->only(['index','show'])->names('admin.tables');

    Route::resource('sales', SaleController::class)->only(['index','create','edit'])->names('admin.sales');
    Route::get('sales/receipt/{sale}', [SaleController::class, 'receipt'])->name('admin.sales.receipt');


    Route::group(['middleware' => ['is.admin']], function(){

        Route::resource('users', UserController::class)->only(['index'])->names('admin.users');
        Route::resource('categories', CategoryController::class)->only(['index'])->names('admin.categories');

    });

});
