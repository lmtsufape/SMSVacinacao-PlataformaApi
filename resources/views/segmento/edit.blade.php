@extends('layouts.app')

@section('content')

<div>
    <h1 class="d-flex justify-content-center h2 pt-4">Editar Campanha</h1>
    <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <form method="POST" action="{{action('CampanhaController@edit')}}">
            @method('put')
            @csrf
            <input type="hidden" name="id" value="{{$obj->id}}" />
            <div class="form-group">
                <div class="form-row">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" value="{{$obj->nome}}">
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="nasc">Idade Início</label>
                        <input type="number" class="form-control" id="idade_ini" placeholder="Idade início" name="idade_ini" value="{{$obj->idade_ini}}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="tel">Idade Final</label>
                        <input type="number" class="form-control" id="idade_end" placeholder="Idade final" name="idade_end" value="{{$obj->idade_end}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="data_ini">Data Início</label>
                        <input type="date" class="form-control" id="data_ini" placeholder="Data Início" name="data_ini" value="{{$obj->data_ini}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="data_end">Data Final</label>
                        <input type="date" class="form-control" id="data_end" placeholder="Data final" name="data_end" value="{{$obj->data_end}}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1" name="atend_domic" value="{{$obj->atend_domic? '1':'0'}}" {{($obj->atend_domic? ' checked' : '')}}>
                    <label class="custom-control-label" for="customSwitch1">Aceita atendimento domiciliar</label>
                </div>
            </div>

            <div class="form-group">
                <div class="form-row">
                    <label for="desc">Descrição</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3">{{$obj->desc}}</textarea>
                </div>
            </div>

            <a href="{{action('CampanhaController@list')}}" class="btn btn-dark">Cancelar</a>
            <button type="submit" class="btn btn-success">Salvar</button>
        </form>
    </div>
</div>
@stop