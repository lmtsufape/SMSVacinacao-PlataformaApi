@extends('layouts.app')

@push('scripts')
<script>
    $(document).ready(function() {
        $(".location").click(function() {
            console.log($(this).data("lat"));
            let lat = $(this).data("lat");
            let lng = $(this).data("lng");
            navigator.geolocation.getCurrentPosition(function(position) {
                window.location.href = `https://www.google.com/maps/dir/?api=1&origin=${position.coords.latitude},${position.coords.longitude}&destination=${lat},${lng}`;
            });
        });
    });
</script>
@endpush

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
        <h1 class="h2">Pacientes</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a id="add" href="{{action('PacienteController@add')}}" class="btn btn-sm btn-outline-primary pt-2 ml-2">
                <span data-feather="plus"></span> Cadastrar
            </a>
            <a href="{{action('PacienteController@list')}}" class="btn btn-sm btn-outline-primary pt-2 ml-2">
                <span data-feather="rotate-ccw"></span> Atualizar
            </a>
        </div>
    </div>

    <table id="unidadetable" class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Localização</th>
                <th>Opcões</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($objs as $obj)
            <tr>
                <td data-toggle="modal" data-target="#modal{{$loop->iteration}}">{{$obj->nome}}</td>
                <td data-toggle="modal" data-target="#modal{{$loop->iteration}}">{{$obj->rua}}, Nº{{$obj->num}}, {{$obj->bairro}}, {{$obj->cidade}}-{{$obj->uf}}</td>
                <td>
                    <div class="d-flex justify-content-around flex-wrap">
                        <button data-lat="{{$obj->lat}}" data-lng="{{$obj->lng}}" class="btn btn-info btn-sm location">Ir até</button>
                        <button data-toggle="modal" data-target="#modal{{$loop->iteration}}" class="btn btn-info btn-sm">Detalhes</button>
                        <a href="{{action('PacienteController@editForm', $obj->cns)}}">
                            <i data-feather="edit"></i>
                            Editar
                        </a>
                        <form class="form-soft" action="{{action('PacienteController@delete', $obj->cns)}}" method="post">
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
@stack('scripts')
@stop