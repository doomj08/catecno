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



//Auth::routes();
Auth::routes(['register' => false]);
Route::get('/login2', function () {
    return view('login');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('index');
    });
    //Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('empresas','EmpresaTransporteController');
    Route::resource('cursos','CursoController');
    Route::resource('conductores','ConductorController');

    Route::resource('certificados','CursoConductorController');
    Route::resource('instituciones','InstitucionController');
    Route::get('lista/conductores','ConductorController@lista');
    Route::get('lista/cursos','CursoController@lista');
});
Route::resource('pdf','CertificadoController');
Route::get('consulta/{id}','CertificadoController@certificados');