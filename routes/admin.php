<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminProfile;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CategoryController;

Route::group(['middleware' => ['auth','verified', 'is.active']], function () {

    Route::get('', [HomeController::class, 'index'])->name('admin.index');

    Route::get('profile', [AdminProfile::class, 'index'])->name('admin.profile');

    Route::resource('clients', ClientController::class)->only(['index'])->names('admin.clients');


    Route::group(['middleware' => ['is.admin', 'is.establishment.updated']], function(){

        Route::resource('users', UserController::class)->only(['index'])->names('admin.users');
        Route::resource('categories', CategoryController::class)->only(['index'])->names('admin.categories');

    });

});
