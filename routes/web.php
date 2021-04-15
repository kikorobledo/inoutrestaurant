<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('setpassword', [SetPasswordController::class, 'create'])->name('setpassword');
    Route::post('setpassword/{user}', [SetPasswordController::class, 'store'])->name('setpassword.store');
});

Route::get('invitation/{user}', [UserController::class, 'invitation'])->name('invitation');
