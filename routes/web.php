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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/super', function(){
    return 'eres super';
})->middleware(['auth','auth.super']);


Route::namespace('Super')->prefix('super')->middleware(['auth','auth.super'])->name('super.')->group(function (){
    Route::resource('/usuarios', 'UserController', ['except' => ['show']]);
});

Route::resource('permisos','PermisoController');
Route::post('/permisoguardar', 'PermisoController@store');

Route::namespace('Dir')->prefix('dir')->middleware(['auth', 'auth.dir'])->name('dir.')->group(function (){
    Route::resource('/permisos', 'PermisosAdmController');
});
Route::get('Dir/permisos/aproved', 'Dir\PermisosAdmController@aproved')->middleware(['auth', 'auth.dir']);
Route::get('Dir/permisos/rejected', 'Dir\PermisosAdmController@rejected')->middleware(['auth', 'auth.dir']);

//Route::get('/crear_tolerancia','ToleranciaController@index')->name('tolerancias');
Route::post('/crear_tolerancia', 'ToleranciaController@buscar');
Route::resource('tolerancias','ToleranciaController');
Route::post('/toleranciaoguardar', 'ToleranciaController@store');