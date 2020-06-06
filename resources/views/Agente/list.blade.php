@extends('layouts.app')

@section('style')
@parent
<style type="text/css">
    #add:hover {
        background-color: limegreen;
    }
</style>
@endsection

@push('scripts')
<script>
    $(document).ready(function($) {
        $('#tableAgente').DataTable();
    });
</script>
@endpush

@section('content')

<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Agentes</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a id="add" href="{{action('AgenteController@add')}}" class="btn btn-sm btn-outline-primary pt-2 ml-2">
                <span data-feather="plus"></span> Cadastrar
            </a>
            <a href="{{action('AgenteController@list')}}" class="btn btn-sm btn-outline-primary pt-2 ml-2">
                <span data-feather="rotate-ccw"></span> Atualizar
            </a>
        </div>
    </div>

    <table id="tableAgente" class="table table-striped table-sm display responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Agente</th>
                <th>CPF</th>
                <th>Email</th>
                <th>Atuação</th>
                <th>Administrador</th>
                <th width="17%">Opcões</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($objs as $obj)
            <tr>
                <td class="text-wrap">{{$obj->nome}}</td>
                <td data-toggle="modal" data-target="#modal{{$loop->iteration}}">{{$obj->cpf}}</td>
                <td data-toggle="modal" data-target="#modal{{$loop->iteration}}">{{$obj->email}}</td>
                <td data-toggle="modal" data-target="#modal{{$loop->iteration}}" class="text-wrap">{{$obj->cidade}}-{{$obj->uf}}</td>
                <td data-toggle="modal" data-target="#modal{{$loop->iteration}}">{{$obj->admin? 'Sim' : 'Não'}}</td>
                <td>

                    <div class="d-flex justify-content-around flex-wrap  ">
                        <div class="d-flex flex-column justify-content-center  ">
                            <a data-toggle="modal" data-target="#modal{{$loop->iteration}}" class=" btn btn-info btn-sm mb-1">Detalhes</a>
                            @can('setAdmin', $obj)
                            <a href="{{action('AgenteController@setAdmin', $obj->id)}}" class="btn btn-primary btn-sm" onclick="return confirm('Deseja mesmo tornar {{$obj->nome}} administrador?')">
                                Tornar Admin
                            </a>
                            @endcan
                        </div>

                        <div class="d-flex flex-column justify-content-center">
                            @can('update', $obj)
                            <a href="{{action('AgenteController@editForm', $obj->id)}}?urlReturn={{URL::full()}}" class="mb-1">
                                <i data-feather="edit"></i>
                                Editar
                            </a>
                            <form class="form-soft" action="{{action('AgenteController@delete', $obj->id)}}" method="post">
                                @method('delete')
                                @csrf
                                <a href="" onclick="if(confirm('Deseja realmente excluir {{$obj->nome}}?')){this.closest('form').submit(); return false;}else{return false}">
                                    <i data-feather="trash-2"></i>
                                    Deletar
                                </a>
                            </form>
                            @endcan
                        </div>
                    </div>
                </td>
            </tr>
            <div class="modal fade bd-example-modal-lg" id="modal{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true" data-backdrop="false">
                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Detalhes do Agente</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <dl class="row mt-3 pt-3 pl-2 ">
                                <dt class="h4 col-sm-3">Nome:</dt>
                                <dd class="h4 col-sm-9">{{$obj->nome}}</dd>
                                <dt class="h4 col-sm-3">CPF:</dt>
                                <dd class="h4 col-sm-9">{{$obj->cpf}}</dd>
                                <dt class="h4 col-sm-3">Administrador:</dt>
                                <dd class="h4 col-sm-9">{{$obj->admin? 'Sim' : 'Não'}}</dd>
                                <dt class="h4 col-sm-3">Atuação:</dt>
                                <dd class="h4 col-sm-9">{{$obj->cidade}}-{{$obj->uf}}</dd>
                            </dl>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>
@stack('scripts')
@stop