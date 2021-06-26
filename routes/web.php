<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web;
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

Route::get('', 'Web\Home')->name('home');
Route::get('test', 'Web\Home@test');

Route::get('changeTheme/{theme}', 'Web\Home@changeTheme')->name('change_theme');

Route::get('catgory/{slug}', function() {

})->name("category");

Route::get('post/{slug}', function() {

})->name("post");

Route::prefix('user')->name('user')->group(function () {
    Route::middleware(['guest'])->group(function() {
        Route::get('login', 'Web\User\Action@login')->name('.login');
        Route::get('register', 'Web\User\Action@register')->name('.register');
    });
    Route::middleware(['auth'])->group(function() {
        Route::get('profile', 'Web\User\Action@profile')->name('.profile');
        Route::get('logout', 'Web\User\Action@logout')->name('.logout');

        Route::middleware(['author'])->group(function () {
            Route::prefix('post')->name('.post')->group(function () {
                //Route::get('add', 'Web\User\Post@add')->name(".add");
            });
        });
    });
    Route::get('active/{user_id}/{hash}', 'Web\User\Action@active')
        ->whereNumber("user_id")->where('hash', '.*')
        ->name('.active');
});

Route::prefix('admin')->name('admin')->group(function() {
    Route::middleware(['moderator'])->group(function() {
        Route::get('', 'Web\Home@admin');
        Route::prefix('post')->name('.post')->group(function() {
            Route::get('', 'Web\Admin\Post');
            Route::get('add', 'Web\Admin\Post@add')->name(".add");

        });
    });
    Route::middleware(['administrator'])->group(function() {
        Route::prefix('category')->name('.category')->group(function() {
            Route::get('', 'Web\Admin\Category');
            Route::get('edit/{id}', 'Web\Admin\Category@edit')->name('.edit')->whereNumber('id');
        });
    });
});