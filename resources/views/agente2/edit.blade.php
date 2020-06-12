@extends('layouts.app')

@push('scripts')
<script>
    $(document).ready(function($) {});
</script>
@endpush

@section('content')

<div>
    <h1 class="d-flex justify-content-center h2 pt-4">Editar Agente</h1>
    <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <form method="POST" action="{{action('AgenteController@edit')}}?urlReturn={{ $urlReturn }}">
            @method('put')
            @csrf
            <input type="hidden" name="id" value="{{$obj->id}}" />
            <div class="form-group">
                <div class="form-row">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" id="nome" placeholder="Nome" name="nome" value="{{$obj->nome}}">
                    @error('nome')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <label for="email">E-mail</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="E-mail" name="email" required autocomplete="email" value="{{$obj->email}}" />
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <label for="cpf">CPF</label>
                    <input type="hidden" name="cpf" value="{{$obj->cpf}}" />
                    <input data-mask="999.999.999-99" data-mask-reverse="true" type="text" class="form-control" id="cpf" disabled value="{{$obj->cpf}}" />
                </div>
            </div>
            @can('setAdmin', $obj)
            <div class=" form-group col-md-12">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1" name="admin" value="{{$obj->admin? '1':'0'}}" {{($obj->admin? ' checked' : '')}}>
                    <label class="custom-control-label" for="customSwitch1">Tornar um administrador</label>
                </div>
            </div>
            @else
            <div class="mt-4 mb-4">
                <h6>Administrador: não.</h6>
            </div>
            @endcan
            <div class="form-group">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cidade">Cidade</label>
                        <select id="cidade" class="form-control" name="cidade">
                            <option selected="selected" value="{{$obj->cidade}}">{{$obj->cidade}}</option>
                            <option @if(old('cidade')=='Garanhuns' ) selected @endif value="Garanhuns">Garanhuns</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="uf">UF</label>
                        <select id="uf" class="form-control" name="uf">
                            <option selected="selected" value="{{$obj->uf}}">{{$obj->uf}}</option>
                            <option @if(old('uf')=='PE' ) selected @endif value="PE">PE</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="password">Senha</label>
                        <input type="password" class="form-control  @error('password') is-invalid @enderror" id="password" placeholder="Senha" name="password" required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-5">
                        <label for="password2">Confirmar Senha</label>
                        <input type="password" class="form-control" id="password2" placeholder="Senha" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
            </div>

            <div class="form-group mt-4">
                <a href="{{ $urlReturn }}" class="btn btn-dark">Cancelar</a>
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>

        </form>
    </div>
</div>
@stack('scripts')
@stop