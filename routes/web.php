<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

/* CRUD Paciente */

Route::get('paciente/add', 'PacienteController@add');
Route::get('paciente/editform/{cns}', 'PacienteController@editForm');
Route::get('paciente/{cns?}', 'PacienteController@list');
Route::post('paciente', 'PacienteController@create');
Route::put('paciente', 'PacienteController@edit');
Route::delete('paciente/{cns?}', 'PacienteController@delete');

/* CRUD Unidade */

Route::get('unidade/teste', 'UnidadeController@teste');
Route::get('unidade/add', 'UnidadeController@add');
Route::get('unidade/editform/{id}', 'UnidadeController@editForm');
Route::get('unidade/{id?}', 'UnidadeController@list');
Route::post('unidade', 'UnidadeController@create');
Route::put('unidade', 'UnidadeController@edit');
Route::delete('unidade/{id?}', 'UnidadeController@delete');

/* CRUD Agente */

Route::get('agente/add', 'AgenteController@add');
Route::get('agente/editform/{cpf}', 'AgenteController@editForm');
Route::get('agente/{cpf?}', 'AgenteController@list');
Route::post('agente', 'AgenteController@create');
Route::put('agente', 'AgenteController@edit');
Route::delete('agente/{cpf?}', 'AgenteController@delete');

/* CRUD Campanha */

Route::get('campanha/add', 'CampanhaController@add');
Route::get('campanha/editform/{id}', 'CampanhaController@editForm');
Route::get('campanha/teste', 'CampanhaController@teste');
Route::get('campanha/{id?}', 'CampanhaController@list');
Route::post('campanha', 'CampanhaController@create');
Route::put('campanha', 'CampanhaController@edit');
Route::delete('campanha/{id?}', 'CampanhaController@delete');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
