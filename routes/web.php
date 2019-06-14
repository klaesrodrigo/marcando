<?php

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
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin/index');
});

Route::prefix('admin')->group(function () {
    Route::get('register', 'QuadraController@create');
    Route::get('list', 'QuadraController@index');
    Route::resource('quadras', 'QuadraController');
});

