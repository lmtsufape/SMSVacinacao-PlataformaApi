@extends('layouts.app')

@section('style')
@parent
<style type="text/css">
    #add:hover {
        background-color: limegreen;
    }
</style>
@endsection
@section('content')

<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Campanhas</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a id="add" href="{{action('CampanhaController@add')}}" class="btn btn-sm btn-outline-primary pt-2 ml-2">
                <span data-feather="plus"></span> Cadastrar
            </a>
            <a href="{{action('CampanhaController@list')}}" class="btn btn-sm btn-outline-primary pt-2 ml-2">
                <span data-feather="rotate-ccw"></span> Atualizar
            </a>
        </div>
    </div>

    <table id="unidadetable" class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Campanha</th>
                <th>Descrição</th>
                <th>Faixa Etária</th>
                <th>Validade da Campanha</th>
                <th>Atend. Domic</th>
                <th>Opções</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($objs as $obj)
            <tr>
                <td data-toggle="modal" data-target="#modal{{$loop->iteration}}">{{$obj->nome}}</td>
                <td data-toggle="modal" data-target="#modal{{$loop->iteration}}">{{$obj->desc}}</td>
                <td data-toggle="modal" data-target="#modal{{$loop->iteration}}">{{$obj->idade_ini}} à {{$obj->idade_end}} anos</td>
                <td data-toggle="modal" data-target="#modal{{$loop->iteration}}">{{$obj->data_ini}} - {{$obj->data_end}}</td>
                <td data-toggle="modal" data-target="#modal{{$loop->iteration}}">{{$obj->atend_domic? 'Sim' : 'Não'}}</td>
                <td>
                    <div class="d-flex justify-content-around flex-wrap">
                        <a href="{{action('CampanhaController@editForm', $obj->id)}}">
                            <i data-feather="edit"></i>
                            Editar
                        </a>
                        <form class="form-soft" action="{{action('CampanhaController@delete', $obj->id)}}" method="post">
                            @method('delete')
                            @csrf
                            <a href="" onclick="if(confirm('Deseja realmente excluir {{$obj->nome}}?')){this.closest('form').submit(); return false;}else{return false}">
                                <i data-feather="trash-2"></i>
                                deletar
                            </a>
                        </form>
                    </div>
                </td>
            </tr>
            <div class="modal fade bd-example-modal-lg" id="modal{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true" data-backdrop="false">
                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <dl class="row mt-3 pt-3 pl-2 ">
                                <dt class="h4 col-sm-3">Nome:</dt>
                                <dd class="h4 col-sm-9">{{$obj->nome}}</dd>
                                <dt class="h4 col-sm-3">Sobrenome:</dt>
                                <dd class="h4 col-sm-9">{{$obj->lat}}</dd>
                                <dt class="h4 col-sm-3">CPF:</dt>
                                <dd class="h4 col-sm-9">{{$obj->lon}}</dd>
                            </dl>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-danger" data-dismiss="modal" aria-label="Close" href="">Recusar</a>
                            <a class="btn btn-success" href="" onclick="$('#modal{{$loop->iteration}}').modal('hide')">Aceitar</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>


@stop