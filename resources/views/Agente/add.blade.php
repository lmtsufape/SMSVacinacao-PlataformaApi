@extends('layouts.app')

@push('scripts')
<script>
    $(document).ready(function($) {
        $("#cpf").mask('999.999.999-99', {
            reverse: false,
            placeholder: "___.___.___-__"
        });
        $('#form').submit(function() {
            $('.unmask').unmask();
        });
    });
</script>
@endpush

@section('content')

<div>
    <h1 class="d-flex justify-content-center h2 pt-4">Cadastrar Novo Agente</h1>
    <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <form method="POST" action="{{action('AgenteController@create')}}">
            @method('post')
            @csrf
            <div class="form-group">
                <div class="form-row">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" ">
                </div>
            </div>
            <div class=" form-group">
                    <div class="form-row">
                        <label for="email">E-mail</label>
                        <input type="text" class="form-control" id="email" placeholder="E-mail" name="email" ">
                </div>
            </div>
            <div class=" form-group">
                        <div class="form-row">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control unmask" id="cpf" placeholder="CPF" name="cpf" ">
                </div>
            </div>
            <div class=" form-group">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="cidade">Cidade</label>
                                    <input type="text" class="form-control" id="cidade" placeholder="Cidade" name="cidade" ">
                    </div>
                    <div class=" form-group col-md-3">
                                    <label for="uf">UF</label>
                                    <select id="uf" class="form-control" name="uf">
                                        <option @if(old('uf')=='AC' ) selected @endif value="AC">AC</option>
                                        <option @if(old('uf')=='AL' ) selected @endif value="AL">AL</option>
                                        <option @if(old('uf')=='AP' ) selected @endif value="AP">AP</option>
                                        <option @if(old('uf')=='AM' ) selected @endif value="AM">AM</option>
                                        <option @if(old('uf')=='BA' ) selected @endif value="BA">BA</option>
                                        <option @if(old('uf')=='CE' ) selected @endif value="CE">CE</option>
                                        <option @if(old('uf')=='DF' ) selected @endif value="DF">DF</option>
                                        <option @if(old('uf')=='ES' ) selected @endif value="ES">ES</option>
                                        <option @if(old('uf')=='GO' ) selected @endif value="GO">GO</option>
                                        <option @if(old('uf')=='MA' ) selected @endif value="MA">MA</option>
                                        <option @if(old('uf')=='MT' ) selected @endif value="MT">MT</option>
                                        <option @if(old('uf')=='MS' ) selected @endif value="MS">MS</option>
                                        <option @if(old('uf')=='MG' ) selected @endif value="MG">MG</option>
                                        <option @if(old('uf')=='PA' ) selected @endif value="PA">PA</option>
                                        <option @if(old('uf')=='PB' ) selected @endif value="PB">PB</option>
                                        <option @if(old('uf')=='PR' ) selected @endif value="PR">PR</option>
                                        <option @if(old('uf')=='PE' ) selected @endif value="PE">PE</option>
                                        <option @if(old('uf')=='PI' ) selected @endif value="PI">PI</option>
                                        <option @if(old('uf')=='RJ' ) selected @endif value="RJ">RJ</option>
                                        <option @if(old('uf')=='RN' ) selected @endif value="RN">RN</option>
                                        <option @if(old('uf')=='RS' ) selected @endif value="RS">RS</option>
                                        <option @if(old('uf')=='RO' ) selected @endif value="RO">RO</option>
                                        <option @if(old('uf')=='RR' ) selected @endif value="RR">RR</option>
                                        <option @if(old('uf')=='SC' ) selected @endif value="SC">SC</option>
                                        <option @if(old('uf')=='SP' ) selected @endif value="SP">SP</option>
                                        <option @if(old('uf')=='SE' ) selected @endif value="SE">SE</option>
                                        <option @if(old('uf')=='TO' ) selected @endif value="TO">TO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="password">Senha</label>
                                    <input type="password" class="form-control" id="password" placeholder="Senha" name="password">
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="password2">Confirmar Senha</label>
                                    <input type="password" class="form-control" id="password2" placeholder="Senha" name="password2">
                                </div>
                            </div>
                        </div>
                        <a href="{{action('AgenteController@list')}}" class="btn btn-dark">Cancelar</a>
                        <button type="submit" class="btn btn-success">Cadastrar</button>
        </form>
    </div>
</div>
@stack('scripts')
@stop