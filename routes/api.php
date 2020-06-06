<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/* CRUD Unidade */

Route::get('unidade/near', 'ApiUnidadeController@near');
Route::get('unidade/add', 'ApiUnidadeController@add');
Route::get('unidade/editform/{id}', 'ApiUnidadeController@editForm');
Route::get('unidade/{id?}', ['uses' => 'ApiUnidadeController@list', 'https' => true]);
Route::post('unidade', 'ApiUnidadeController@create');
Route::put('unidade', 'ApiUnidadeController@edit');
Route::delete('unidade/{id?}', 'ApiUnidadeController@delete');

/* CRUD Segmento */

Route::get('segmento/addcampanha', 'ApiSegmentoController@addCampanha');
Route::get('segmento/listtest/{id?}', 'ApiSegmentoController@listTest');
Route::put('segmento/listtest/{id?}', 'ApiSegmentoController@updateTest');
Route::delete('segmento/listtest/{id?}', 'ApiSegmentoController@deleteTest');
Route::get('segmento/addpublico', 'ApiSegmentoController@addPublico');
Route::get('segmento/addidade', 'ApiSegmentoController@addIdade');
Route::get('segmento/editform/{id}', 'ApiSegmentoController@editForm');
Route::get('segmento/{id?}', 'ApiSegmentoController@list');
Route::post('segmento', 'ApiSegmentoController@create');
Route::put('segmento', 'ApiSegmentoController@edit');
Route::delete('segmento/{id?}', 'ApiSegmentoController@delete');

/* CRUD Paciente */

Route::get('paciente/add', 'ApiPacienteController@add');
Route::get('paciente/editform/{cns}', 'ApiPacienteController@editForm');
Route::get('paciente/{cns?}', 'ApiPacienteController@list');
Route::post('paciente', 'ApiPacienteController@create');
Route::put('paciente', 'ApiPacienteController@edit');
Route::delete('paciente/{cns?}', 'ApiPacienteController@delete');


/* CRUD Solicitacao */


Route::get('solicitacao/paciente/{id}', 'ApiSolicitacaoController@pacienteSolic');
Route::post('solicitacao/paciente/{id}', 'ApiSolicitacaoController@createPacienteSolic');
Route::get('solicitacao/delegadas/agente/{id?}', 'ApiSolicitacaoController@agenteSolicDeleg');
Route::get('solicitacao/atribuidas/agente/{id?}', 'ApiSolicitacaoController@agenteSolicAtrib');
Route::post('solicitacao/recusar/{id}', 'ApiSolicitacaoController@recusar');
Route::post('solicitacao/aceitar/{id}', 'ApiSolicitacaoController@aceitar');
Route::post('solicitacao/atender/{id}', 'ApiSolicitacaoController@atender');
Route::get('solicitacao/status/{id}', 'ApiSolicitacaoController@getStatus');
Route::get('solicitacao/add', 'ApiSolicitacaoController@add');
Route::get('solicitacao/editform/{id}', 'ApiSolicitacaoController@editForm');
Route::get('solicitacao/{id?}', 'ApiSolicitacaoController@list');
Route::post('solicitacao', 'ApiSolicitacaoController@create');
Route::put('solicitacao', 'ApiSolicitacaoController@edit');
Route::delete('solicitacao/{id?}', 'ApiSolicitacaoController@delete');