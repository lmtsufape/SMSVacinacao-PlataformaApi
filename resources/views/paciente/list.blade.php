@extends('layouts.app')

@push('scripts')
<script>
    $(document).ready(function($) {
        $('#tablePaciente').DataTable({
            "language": {
                "lengthMenu": "Exibir _MENU_ registros por página",
                "zeroRecords": "Nada encontrado - desculpe",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ total de registros)"
            },
        });
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

    <table id="tablePaciente" class="table table-striped table-sm display responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Paciente</th>
                <th>Localização</th>
                <th width="21%">Opcões</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($objs as $obj)
            <tr>
                <td class="text-wrap">{{$obj->nome}}</td>
                <td data-toggle="modal" data-target="#modal{{$loop->iteration}}" class="text-wrap">Rua {{$obj->rua}}, Nº{{$obj->num}}, Bairro {{$obj->bairro}}, {{$obj->cidade}}-{{$obj->uf}}</td>
                <td>
                    <div class="d-flex justify-content-around flex-wrap">
                        <div class="d-flex flex-column justify-content-center mb-1 mr-1">
                            <a data-toggle="modal" data-target="#modal{{$loop->iteration}}" class="btn btn-info btn-sm">Detalhes</a>
                        </div>

                        <div class="d-flex flex-column m-1">
                            <a href="tel:{{$obj->tel}}" class="btn btn-primary btn-sm mb-1 mr-1">Ligar</a>
                            <a data-lat="{{$obj->lat}}" data-lng="{{$obj->lng}}" class="btn btn-info btn-sm location mb-1 mr-1">Ir até</a>
                        </div>
                        @can('create', App\Paciente::class)
                        <div class="d-flex flex-column m-1">
                            <a href="{{action('PacienteController@editForm', $obj->cns)}}" class="mb-1 mr-">
                                <i data-feather="edit"></i>
                                Editar
                            </a>
                            <form class="form-soft" action="{{action('PacienteController@delete', $obj->cns)}}" method="post">
                                @method('delete')
                                @csrf
                                <a href="" onclick="if(confirm('Deseja realmente excluir {{$obj->nome}}?')){this.closest('form').submit(); return false;}else{return false}">
                                    <i data-feather="trash-2"></i>
                                    Deletar
                                </a>
                            </form>
                        </div>
                        @endcan
                    </div>
                </td>
            </tr>
            <div class="modal fade bd-example-modal-lg" id="modal{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true" data-backdrop="false">
                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Detalhes do Paciente</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <dl class="row mt-3 pt-3 pl-2 ">
                                <dt class="h4 col-sm-3">Nome:</dt>
                                <dd class="h4 col-sm-9">{{$obj->nome}}</dd>
                                <dt class="h4 col-sm-3">CNS:</dt>
                                <dd class="h4 col-sm-9">{{$obj->cns}}</dd>
                                <dt class="h4 col-sm-3">Telefone:</dt>
                                <dd class="h4 col-sm-9"><a href="tel:{{$obj->tel}}">{{$obj->tel}}</a> <a href="tel:{{$obj->tel}}" class="btn btn-primary btn-sm">Ligar</a></dd>
                                <dt class="h4 col-sm-3">Nascimento:</dt>
                                <dd class="h4 col-sm-9">{{$obj->nasc}}</dd>
                                <dt class="h4 col-sm-3">Rua:</dt>
                                <dd class="h4 col-sm-9">{{$obj->rua}}</dd>
                                <dt class="h4 col-sm-3">Número:</dt>
                                <dd class="h4 col-sm-9">{{$obj->num}}</dd>
                                <dt class="h4 col-sm-3">Complemento:</dt>
                                <dd class="h4 col-sm-9">{{$obj->complemento}}</dd>
                                <dt class="h4 col-sm-3">Bairro:</dt>
                                <dd class="h4 col-sm-9">{{$obj->bairro}}</dd>
                                <dt class="h4 col-sm-3">Cidade:</dt>
                                <dd class="h4 col-sm-9">{{$obj->cidade}}</dd>
                                <dt class="h4 col-sm-3">Estado:</dt>
                                <dd class="h4 col-sm-9">{{$obj->uf}}</dd>
                                <dt class="h4 col-sm-3">Coordenadas:</dt>
                                <dd class="h4 col-sm-9">{{$obj->lat}}, {{$obj->lng}}</dd>
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