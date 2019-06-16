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
    Route::get('form', 'QuadraController@create');
    Route::get('list', 'QuadraController@index');
    Route::get('config/list', 'QuadraController@listaQuadra');
    Route::get('config/{id}/{cid}', 'QuadraController@configuraQuadra')->name('quadras.config');
    Route::post('config', 'QuadraController@configuraQuadra')->name('quadras.tipo');
    Route::delete('config/delete/{id}/{cid}', 'QuadraController@destroyQuadraTipo')->name('quadras.tipoDestroy');
    Route::get('config/{id}', 'QuadraController@editQuadraTipo')->name('quadras.tipoEdit');
    Route::put('config/{qaid}/{id}/{cid}', 'QuadraController@updateQuadraTipo')->name('quadras.tipoUpdate');
    Route::post('config/insere/{id}/{cid}', 'QuadraController@insereQuadraTipo')->name('quadras.insereTipo');
    Route::resource('quadras', 'QuadraController');
});

