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
    Route::resource('/usuarios', 'UserController');
    Route::resource('/vacas', 'VacasSuperController');
    Route::get('/upvacas', 'VacasSuperController@actualizar');
    Route::get('/invierno', 'VacasSuperController@invierno');
    Route::get('/verano', 'VacasSuperController@verano');
    Route::resource('/horarios', 'HorarioController');
});

//Route::get('/edit/{id}', 'Super\UserController@user_edit');
Route::post('/upuser', 'Super\UserController@editar_usuario');
Route::get('/edit_user/{id}', [ 'as' => 'user_edit', 'uses' => 'Super\UserController@user_edit'])->middleware(['auth','auth.super']);

Route::resource('permisos','PermisoController');
Route::resource('solvacas','VacasSolController');
Route::get('/solverano', 'VacasSolController@verano');
Route::get('/solinvierno', 'VacasSolController@invierno');
Route::post('/crear_vacas/{id}', 'VacasSolController@dias');
Route::post('/permisoguardar', 'PermisoController@store');

Route::namespace('Dir')->prefix('dir')->middleware(['auth', 'auth.dir', 'auth.adm'])->name('dir.')->group(function (){
    Route::resource('/permisos', 'PermisosAdmController');
    Route::resource('/vacaciones', 'VacasAdmController');
});
Route::get('Dir/permisos/aproved', 'Dir\PermisosAdmController@aproved')->middleware(['auth', 'auth.dir']);
Route::get('Dir/permisos/rejected', 'Dir\PermisosAdmController@rejected')->middleware(['auth', 'auth.dir']);
Route::get('/hola', 'Dir\PermisosAdmController@reporte')->middleware(['auth', 'auth.dir']);

Route::get('Dir/vacaciones/espera', 'Dir\VacasAdmController@espera')->middleware(['auth', 'auth.dir']);
Route::get('Dir/vacaciones/aproved', 'Dir\VacasAdmController@aproved')->middleware(['auth', 'auth.dir']);
Route::get('Dir/vacaciones/rejected', 'Dir\VacasAdmController@rejected')->middleware(['auth', 'auth.dir']);
Route::get('Dir/vacaciones/personal', 'Dir\VacasAdmController@vacasper')->middleware(['auth', 'auth.dir']);
Route::get('Dir/vacaciones/descargar', 'Dir\VacasAdmController@fun_pdf')->middleware(['auth', 'auth.dir']);

//Route::get('/crear_tolerancia','ToleranciaController@index')->name('tolerancias');
Route::post('/crear_tolerancia', 'ToleranciaController@buscar');
Route::resource('tolerancias','ToleranciaController');
Route::post('/toleranciaoguardar', 'ToleranciaController@store');

Route::resource('vacas','VacasController');

