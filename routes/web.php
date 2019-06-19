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

Route::get('/', 'QuadraController@listaQuadrasSite')->name('inicio');

Route::get('/admin', function () {
    return view('admin/index');
})->middleware('auth');

Route::get('/ver/{id}', 'QuadraController@ver')->name('quadras.ver');

Route::post('/marcar', 'MarcacaoController@store')->name('marcacoes.store');
Route::get('/mail/{id}', 'MarcacaoController@enviarEmail')->name('enviarEmail');

Route::prefix('admin')->group(function () {
    Route::get('marcacao/{id}', 'MarcacaoController@show')->name('marcacao.index');
    Route::get('graf', 'QuadraController@graf')->name('graf');
    Route::get('rel', 'QuadraController@rel')->name('rel');
    Route::delete('marcacao/{id}', 'MarcacaoController@destroy')->name('marcacao.destroy');
    Route::get('form', 'QuadraController@create');
    Route::get('list', 'QuadraController@index');
    Route::get('config/list', 'QuadraController@listaQuadra')->name('list');
    Route::get('config/{id}/{cid}', 'QuadraController@configuraQuadra')->name('quadras.config');
    Route::post('config', 'QuadraController@configuraQuadra')->name('quadras.tipo');
    Route::delete('config/delete/{id}/{cid}', 'QuadraController@destroyQuadraTipo')->name('quadras.tipoDestroy');
    Route::get('config/{id}', 'QuadraController@editQuadraTipo')->name('quadras.tipoEdit');
    Route::put('config/{qaid}/{id}/{cid}', 'QuadraController@updateQuadraTipo')->name('quadras.tipoUpdate');
    Route::post('config/insere/{id}/{cid}', 'QuadraController@insereQuadraTipo')->name('quadras.insereTipo');
    Route::resource('quadras', 'QuadraController');
});

Auth::routes();

Route::get('/home', function(){
    return redirect('/admin');
})->name('home');
