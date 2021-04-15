<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminProfile;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;


Route::group(['middleware' => ['auth','verified']], function () {

    Route::get('', [HomeController::class, 'index'])->name('admin.index');

    Route::get('profile', [AdminProfile::class, 'index'])->name('admin.profile');

    Route::resource('users', UserController::class)->except(['show', 'create', 'edit'])->names('admin.users');
    Route::resource('categories', CategoryController::class)->except(['show', 'create', 'edit'])->names('admin.categories');

});
