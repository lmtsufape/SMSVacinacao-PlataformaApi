@extends('layouts.app')

@section('content')
<div class="col-xl-12">
    <h1 class="d-flex justify-content-center h2 pt-4">Editar Público</h1>
    <div class="d-flex justify-content-center align-items-center pt-3 pb-2 mb-3 border-bottom">
        <form method="POST" action="{{action('PublicoController@edit')}}">
            @method('put')
            @csrf
            <input type="hidden" name="id" value="{{$obj->id}}" />
            <div class="form-group col-md-12 mb-5" style="width: 310px;">
                <div class="form-row">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" value="{{$obj->nome}}" required autocomplete="nome" autofocus >
                </div>
            </div>

            <div class="form-group col-md-12 ">
                <a href="{{ URL::previous() }}" class="btn btn-dark">Cancelar</a>
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </form>
    </div>
</div>
@stop