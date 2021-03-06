<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;

Route::get('', [HomeController::class, 'index'])->name('admin.index');

Route::resource('users', UserController::class)->except(['show', 'create', 'edit'])->names('admin.users');
