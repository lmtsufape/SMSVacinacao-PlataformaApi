@extends('layouts.app')

@section('content')
<div class="col-xl-12">
    <h1 class="d-flex justify-content-center h2 pt-4">Cadastrar Nova Público</h1>
    <div class="d-flex justify-content-center align-items-center pt-3 pb-2 mb-3 border-bottom ">
        <form method="POST" action="{{action('PublicoController@create')}}?urlReturn={{$urlReturn}}">
            @method('post')
            @csrf
            <div class="form-group col-md-12 mb-5 " style="width: 310px;">
                <div class="form-row ">
                    <div class="col-md-12">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control col-md-12" id="nome" placeholder="Nome" name="nome">
                    </div>
                </div>
            </div>
            <div class="form-group col-md-12 ">
                <a href="{{$urlReturn}}" class="btn btn-dark">Cancelar</a>
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
        </form>
    </div>
</div>
@stop