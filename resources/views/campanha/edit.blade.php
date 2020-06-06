@extends('layouts.app')


@push('addCampanha')
<script>
    $(document).ready(function($) {
        $("select.termo").change(function() {
            selectedTermo = $(this).children("option:selected").val();
            $('#tablePublico > tbody').html('');
            var urlProcess = "{{action('TermoController@list')}}/" + selectedTermo + "?json=true";
            $.ajax({
                type: "GET",
                url: urlProcess,
                success: function(result) {
                    $("#termo_desc").val(result.desc);
                },
            });

        });
    });
</script>
@endpush
@section('content')

<div class="col-xl-12">
    <h1 class="d-flex justify-content-center h2 pt-4">Editar Campanha</h1>
    <div class="d-flex justify-content-center align-items-center pt-3 pb-2 mb-3 border-bottom">
        <form method="POST" action="{{action('CampanhaController@edit')}}?urlReturn={{ $urlReturn }}">
            @method('put')
            @csrf
            <input type="hidden" name="id" value="{{$obj->id}}" />
            <div class="form-group col-md-12 " style="width: 330px;">
                <div class=" form-row">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" value="{{$obj->nome}}" required autocomplete="nome" autofocus>
                </div>
            </div>

            <div class="form-group col-md-12">
                <div class="form-row">
                    <label for="desc">Descrição</label>
                    <textarea class="form-control" id="desc" name="desc" rows="6" value="{{$obj->desc}}" required autocomplete="desc" autofocus>{{$obj->desc}}</textarea>
                </div>
            </div>

            <div class="form-group col-md-12">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1" name="atend_domic" value="{{$obj->atend_domic? '1':'0'}}" {{($obj->atend_domic? ' checked' : '')}}>
                    <label class="custom-control-label" for="customSwitch1">Aceita atendimento domiciliar</label>
                </div>
            </div>
            <div class="form-group col-md-12 mb-5">
                <div class="form-row">
                    <div class="form-group col-md-7">
                        <label for="termo">Termo</label>
                        <select id="termo" class="form-control termo" name="termo_id" >
                            <option selected value="{{$objT->id}}"> {{$objT->nome}}</option>
                            @foreach($objsT as $objFT)
                            <option value="{{$objFT->id}}">{{$objFT->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-5 ">
                        <label for="nome" class="mb-5"> </label>
                        <a href="{{action('TermoController@add')}}" class="btn btn-success mt-2">Novo Termo</a>
                    </div>
                </div>
                <div class="form-row">
                    <textarea class="form-control" id="termo_desc" name="termo_desc" disabled rows="5" value="{{$objT->desc}}" required autocomplete="termo_desc" autofocus>{{$objT->desc}}</textarea>
                </div>
            </div>

            <div class="form-group col-md-12">
                <a href="{{ $urlReturn }}" class="btn btn-dark">Cancelar</a>
                <button type="submit" class="btn btn-success">Alterar</button>
            </div>

        </form>
    </div>
</div>
@stack('addCampanha')
@stop