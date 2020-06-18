<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/panel', function () {
    return view('index');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('empresas','EmpresaTransporteController');
    Route::resource('cursos','CursoController');
    Route::resource('conductores','ConductorController');
    Route::resource('certificados','CursoConductorController');
    Route::resource('instituciones','InstitucionController');
});
Route::resource('pdf','CertificadoController');
Route::get('consulta/{id}','CertificadoController@certificados');