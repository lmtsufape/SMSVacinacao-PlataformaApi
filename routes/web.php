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

Route::get('unidade/near', 'UnidadeController@near');
Route::get('unidade/add', 'UnidadeController@add');
Route::get('unidade/editform/{id}', 'UnidadeController@editForm');
Route::get('unidade/{id?}', ['uses' => 'UnidadeController@list', 'https' => true]);
Route::post('unidade', 'UnidadeController@create');
Route::put('unidade', 'UnidadeController@edit');
Route::delete('unidade/{id?}', 'UnidadeController@delete');

/* CRUD Agente */

Route::get('agente/add', 'AgenteController@add');
Route::get('agente/teste', 'AgenteController@teste');
Route::get('agente/editform/{cpf}', 'AgenteController@editForm');
Route::get('agente/{cpf?}', 'AgenteController@list');
Route::post('agente', 'AgenteController@create');
Route::put('agente', 'AgenteController@edit');
Route::delete('agente/{cpf?}', 'AgenteController@delete');

/* CRUD Termo */

Route::get('termo/add', 'TermoController@add');
Route::get('termo/editform/{id}', 'TermoController@editForm');
Route::get('termo/{id?}', 'TermoController@list');
Route::post('termo', 'TermoController@create');
Route::put('termo', 'TermoController@edit');
Route::delete('termo/{id?}', 'TermoController@delete');


/* CRUD Periodo */

/* Route::get('periodo/add', 'PeriodoController@add');
Route::get('periodo/editform/{id}', 'PeriodoController@editForm');
Route::get('periodo/{id?}', 'PeriodoController@list');
Route::post('periodo', 'PeriodoController@create');
Route::put('periodo', 'PeriodoController@edit');
Route::delete('periodo/{id?}', 'PeriodoController@delete'); */

/* CRUD Grupo */
/* 
Route::get('grupo/add', 'GrupoController@add');
Route::get('grupo/editform/{id}', 'GrupoController@editForm');
Route::get('grupo/{id?}', 'GrupoController@list');
Route::post('grupo', 'GrupoController@create');
Route::put('grupo', 'GrupoController@edit');
Route::delete('grupo/{id?}', 'GrupoController@delete'); */

/* CRUD Idade */

Route::get('idade/add', 'IdadeController@add');
Route::get('idade/editform/{id}', 'IdadeController@editForm');
Route::get('idade/{id?}', 'IdadeController@list');
Route::post('idade', 'IdadeController@create');
Route::put('idade', 'IdadeController@edit');
Route::delete('idade/{id?}', 'IdadeController@delete');

/* CRUD Segmento */

Route::get('segmento/add', 'SegmentoController@add');
Route::get('segmento/editform/{id}', 'SegmentoController@editForm');
Route::get('segmento/{id?}', 'SegmentoController@list');
Route::post('segmento', 'SegmentoController@create');
Route::put('segmento', 'SegmentoController@edit');
Route::delete('segmento/{id?}', 'SegmentoController@delete');

/* CRUD Publico */

/* Route::get('publico/add', 'PublicoController@add');
Route::get('publico/editform/{id}', 'PublicoController@editForm');
Route::get('publico/{id?}', 'PublicoController@list');
Route::post('publico', 'PublicoController@create');
Route::put('publico', 'PublicoController@edit');
Route::delete('publico/{id?}', 'PublicoController@delete'); */

/* CRUD Vacina */

/* Route::get('vacina/add', 'VacinaController@add');
Route::get('vacina/editform/{id}', 'VacinaController@editForm');
Route::get('vacina/{id?}', 'VacinaController@list');
Route::post('vacina', 'VacinaController@create');
Route::put('vacina', 'VacinaController@edit');
Route::delete('vacina/{id?}', 'VacinaController@delete'); */

/* CRUD Campanha */

Route::get('campanha/add', 'CampanhaController@add');
Route::get('campanha/editform/{id}', 'CampanhaController@editForm');
Route::get('campanha/teste', 'CampanhaController@teste');
Route::get('campanha/{id?}', 'CampanhaController@list');
Route::post('campanha', 'CampanhaController@create');
Route::put('campanha', 'CampanhaController@edit');
Route::delete('campanha/{id?}', 'CampanhaController@delete');

/* CRUD Solicitacao */


Route::get('solicitacao/paciente/{id}', 'SolicitacaoController@pacienteSolic');
Route::get('solicitacao/delegadas/agente/{id?}', 'SolicitacaoController@agenteSolicDeleg');
Route::get('solicitacao/atribuidas/agente/{id?}', 'SolicitacaoController@agenteSolicAtrib');
Route::post('solicitacao/recusar/{id}', 'SolicitacaoController@recusar');
Route::post('solicitacao/atender/{id}', 'SolicitacaoController@atender');
Route::get('solicitacao/status/{id}', 'SolicitacaoController@getStatus');
Route::get('solicitacao/add', 'SolicitacaoController@add');
Route::get('solicitacao/editform/{id}', 'SolicitacaoController@editForm');
Route::get('solicitacao/{id?}', 'SolicitacaoController@list');
Route::post('solicitacao', 'SolicitacaoController@create');
Route::put('solicitacao', 'SolicitacaoController@edit');
Route::delete('solicitacao/{id?}', 'SolicitacaoController@delete');

/* CRUD Agendamento */

Route::get('agendamento/add', 'AgendamentoController@add');
Route::get('agendamento/editform/{id}', 'AgendamentoController@editForm');
Route::get('agendamento/{id?}', 'AgendamentoController@list');
Route::post('agendamento', 'AgendamentoController@create');
Route::put('agendamento', 'AgendamentoController@edit');
Route::delete('agendamento/{id?}', 'AgendamentoController@delete');


Auth::routes();

Route::get('/home', 'PacienteController@list')->name('home');
