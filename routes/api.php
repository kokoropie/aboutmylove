<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('user')->name('user')->group(function () {
    Route::middleware(['guest'])->group(function() {
        Route::post('login', 'Api\Auth@login')->name('.login');
        Route::post('register', 'Api\Auth@register')->name('.register');
    });
    Route::middleware(['auth'])->group(function() {
        Route::post('send_email_active', 'Api\Auth@send_email_active')->name('.send_email_active');
    });
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('post', 'Api\Admin\Post');

    Route::resource('category', 'Api\Admin\Category');
    Route::delete('category/{id}/destroy', 'Api\Admin\Category@destroyMulti')->name('category.destroyMulti');
});
