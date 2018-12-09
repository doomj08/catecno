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
    return view('auth/login');
});
Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::Resource('conductores', 'ConductorController');
    Route::post('conductores/restore/{id}','ConductorController@restore');
    Route::get('conductores/paginas/{paginas}', 'ConductorController@paginate');

    Route::Resource('cursos', 'CursoController');
    Route::post('cursos/restore/{id}','CursoController@restore');
    Route::get('cursos/paginas/{paginas}', 'CursoController@paginate');

    Route::Resource('empresas', 'EmpresaTransporteController');
    Route::post('empresas/restore/{id}','EmpresaTransporteController@restore');
    Route::get('empresas/paginas/{paginas}', 'EmpresaTransporteController@paginate');

    Route::Resource('certificados', 'CursoConductorController');
    Route::post('certificados/restore/{id}','CursoConductorController@restore');
    Route::get('certificados/paginas/{paginas}', 'CursoConductorController@paginate');

    Route::get('certificados/listas/obtener', 'CursoConductorController@getListas');

      Route::get('/home', 'HomeController@index')->name('home');
});

