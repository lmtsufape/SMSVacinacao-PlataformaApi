@extends('layouts.app')

@section('content')
<div class="col-xl-12">
    <h1 class="d-flex justify-content-center h2 pt-4">Cadastrar Nova Termo</h1>
    <div class="d-flex justify-content-center align-items-center pt-3 pb-2 mb-3 border-bottom">
        <form method="POST" action="{{action('TermoController@create')}}?urlReturn={{ $urlReturn }}">
            @method('post')
            @csrf
            <div class="form-group col-md-12" style="width: 310px;">
                <div class="form-row">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" required autocomplete="nome" autofocus value="{{ old('nome') }}">
                </div>
            </div>

            <div class="form-group col-md-12 mb-5">
                <div class="form-row">
                    <label for="desc">Descrição</label>
                    <textarea class="form-control" id="desc" name="desc" rows="10" required autocomplete="desc" autofocus value="{{ old('desc') }}"></textarea>
                </div>
            </div>

            <div class="form-group col-md-12">
                <a href="{{ $urlReturn }}" class="btn btn-dark">Cancelar</a>
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>

        </form>
    </div>
</div>
@stop