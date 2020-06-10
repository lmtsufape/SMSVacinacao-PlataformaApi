<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Mockery\Undefined;
use Illuminate\Support\Facades\Auth;

class ApiRelatorioController extends Controller
{
    //

    public function list()
    {


        return view('relatorio.list');
    }

    public function snVacinados(Request $request)
    {

        $params =  collect($request->only(['period', 'division', 'user']));
        $obj = '';
        $restantes = '';
        $vacinados = '';
        $divisao = $params['division'];

        if ($params['user'] === 'true') {
            if (Auth::check()) {
                $agente = Auth::user();
                return $agente;
                $solicitacao = $agente->solicitacoesDelegadas();
                if ($params['period'] === 'anual') {
                    $obj = $solicitacao->whereYear('solicitacoes.created_at', date('Y'))
                        ->join('pacientes', 'paciente_cns', '=', 'pacientes.cns')
                        ->select(DB::raw('solicitacoes.status, pacientes.' . $divisao))
                        ->get();
                } elseif ($params['period'] === 'mensal') {
                    $obj = $solicitacao->whereYear('solicitacoes.created_at', date('Y'))
                        ->whereMonth('solicitacoes.created_at', date('m'))
                        ->join('pacientes', 'paciente_cns', '=', 'pacientes.cns')
                        ->select(DB::raw('solicitacoes.status, pacientes.' . $divisao))
                        ->get();
                } elseif ($params['period'] === 'diario') {
                    $obj = $solicitacao->whereDate('solicitacoes.created_at', date('Y-m-d'))
                        ->join('pacientes', 'paciente_cns', '=', 'pacientes.cns')
                        ->select(DB::raw('solicitacoes.status, pacientes.' . $divisao))
                        ->get();
                }
            }
        } else {
            if ($params['period'] === 'anual') {
                $obj = \App\Solicitacao::whereYear('solicitacoes.created_at', date('Y'))
                    ->join('pacientes', 'paciente_cns', '=', 'pacientes.cns')
                    ->select(DB::raw('solicitacoes.status, pacientes.' . $divisao))
                    ->get();
            } elseif ($params['period'] === 'mensal') {
                $obj = \App\Solicitacao::whereYear('solicitacoes.created_at', date('Y'))
                    ->whereMonth('solicitacoes.created_at', date('m'))
                    ->join('pacientes', 'paciente_cns', '=', 'pacientes.cns')
                    ->select(DB::raw('solicitacoes.status, pacientes.' . $divisao))
                    ->get();
            } elseif ($params['period'] === 'diario') {
                $obj = \App\Solicitacao::whereDate('solicitacoes.created_at', date('Y-m-d'))
                    ->join('pacientes', 'paciente_cns', '=', 'pacientes.cns')
                    ->select(DB::raw('solicitacoes.status, pacientes.' . $divisao))
                    ->get();
            }
        }



        $restantes = $obj->groupBy([function ($item) {
            if ($item['status'] !== 'Recusado') {
                return 'Restante';
            };
        }, $divisao]);

        $vacinados = $obj->groupBy([function ($item) {
            if ($item['status'] === 'Vacinado') {
                return 'Vacinado';
            }
        }, $divisao]);

        $prepData = $vacinados->has('Vacinado') ? $restantes->only('Restante')->merge($vacinados->only('Vacinado')) : $restantes->only('Restante');

        $groupCount = $prepData->map(function ($item, $key) {
            return $item->map(function ($item, $key) {
                return collect($item)->count();
            });
        });

        $labels = collect();

        if ($groupCount->has('Restante') || $groupCount->has('Vacinado')) {
            if ($groupCount->has('Restante')) {
                $labels = $groupCount['Restante']->keys();
                if ($groupCount->has('Vacinado')) {
                    $labels = $labels->merge($groupCount['Vacinado']->keys())->unique();
                }
            }
        }

        $data = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Restante',
                    'data' => $labels->map(function ($item, $key) use ($groupCount) {
                        return $groupCount['Restante']->has($item) ? $groupCount['Restante'][$item] : 0;
                    })
                ],
                [
                    'label' => 'Vacinado',
                    'data' => $labels->map(function ($item, $key) use ($groupCount) {
                        if ($groupCount->has('Vacinado')) {
                            return $groupCount['Vacinado']->has($item) ? $groupCount['Vacinado'][$item] : 0;
                        } else {
                            return 0;
                        }
                    })
                ]
            ]

        ];
        return  $data;
    }

    public function snPacientes()
    {

        $obj = \App\Solicitacao::whereYear('solicitacoes.created_at', '2020')
            ->join('pacientes', 'paciente_cns', '=', 'pacientes.cns')
            ->select(DB::raw('solicitacoes.status, pacientes.bairro'))
            ->get();

        $restantes = $obj->groupBy([function ($item) {
            if ($item['status'] !== 'Recusado') {
                return 'Restante';
            };
        }, 'bairro']);

        $vacinados = $obj->groupBy([function ($item) {
            if ($item['status'] === 'Vacinado') {
                return 'Vacinado';
            }
        }, 'bairro']);

        $prepData = $vacinados->has('Vacinado') ? $restantes->only('Restante')->merge($vacinados->only('Vacinado')) : $restantes->only('Restante');

        $groupCount = $prepData->map(function ($item, $key) {
            return $item->map(function ($item, $key) {
                return collect($item)->count();
            });
        });

        $labels = collect();

        if ($groupCount->has('Restante') || $groupCount->has('Vacinado')) {
            if ($groupCount->has('Restante')) {
                $labels = $groupCount['Restante']->keys();
                if ($groupCount->has('Vacinado')) {
                    $labels = $labels->merge($groupCount['Vacinado']->keys())->unique();
                }
            }
        }

        $data = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Restante',
                    'data' => $labels->map(function ($item, $key) use ($groupCount) {
                        return $groupCount['Restante']->has($item) ? $groupCount['Restante'][$item] : 0;
                    })
                ],
                [
                    'label' => 'Vacinado',
                    'data' => $labels->map(function ($item, $key) use ($groupCount) {
                        if ($groupCount->has('Vacinado')) {
                            return $groupCount['Vacinado']->has($item) ? $groupCount['Vacinado'][$item] : 0;
                        } else {
                            return 0;
                        }
                    })
                ]
            ]

        ];
        return  $data;
    }
}
