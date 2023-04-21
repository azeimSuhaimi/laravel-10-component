<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\userController;

use Illuminate\Support\Facades\Route;

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

Route::controller(authController::class)->group(function () {

    Route::get('/','index')->name('auth')->middleware('guest');
    Route::post('/auth','login')->name('auth.login')->middleware('guest');

    Route::get('/logout','logout')->name('auth.logout')->middleware('auth');

    Route::get('/forgot_password', 'forgot_password')->name('auth.forgot_password')->middleware('guest');
    Route::post('/forgot_password', 'forgot_password_email')->name('auth.forgot_password.email')->middleware('guest');

    Route::get('/reset','reset')->name('auth.reset')->middleware('guest');
    Route::post('/reset','reset_password')->name('auth.reset.password')->middleware('guest');

});

Route::controller(userController::class)->group(function () {
   
    Route::get('/change_password','change_password')->name('user.change_password')->middleware('auth');
    Route::post('/change_password','change_password_process')->name('user.change_password_process')->middleware('auth');
    
    Route::get('/profile','profile')->name('user.profile')->middleware('auth');
    Route::post('/profile_image','profile_image')->name('user.profile_image')->middleware('auth');
    Route::post('/edit_profile','edit_profile')->name('user.edit_profile')->middleware('auth');

    Route::get('/roles','roles')->name('user.roles')->middleware(['auth','is_admin']);
    Route::get('/show_roles','show_roles')->name('user.show.roles')->middleware(['auth','is_admin']);
    Route::post('/edit_roles','edit_roles')->name('user.edit.roles')->middleware(['auth','is_admin']);
});
