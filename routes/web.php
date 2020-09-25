<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
    return redirect('loja');
});

Route::get('loja', 'App\Http\Controllers\UsersController@index');

Route::get('loja/create', 'App\Http\Controllers\UsersController@create')->name('create');

Route::post('loja/create', 'App\Http\Controllers\UsersController@store')->name('store');

Route::post('whatsapp', 'App\Http\Controllers\UsersController@whatsapp')->name('whatsapp');
