@extends('layouts.entry')

@push('scripts')
<script>
    $(document).ready(function($) {
        $('#cpf').mask('000.000.000-00', {
            reverse: false
        });
    });
</script>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cpf" class="col-md-4 col-form-label text-md-right">CPF</label>

                            <div class="col-md-6">
                                <input id="cpf" type="text" class="form-control @error('cpf') is-invalid @enderror" name="cpf" value="{{ old('cpf') }}" required autocomplete="cpf" autofocus>

                                @error('cpf')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Endereço de e-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirme a Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-6 row">
                                <div class="form-group">
                                    <label for="cidade-select" class="col-md-12 col-form-label text-md-left">Cidade</label>
                                    <div class="col-md-12">
                                        <select id="cidade-select" class="form-control" name="cidade">
                                            <option value="Garanhuns">Garanhuns</option>
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="uf-select" class="col-md-12 col-form-label text-md-left">UF</label>
                                    <div class="col-md-12">
                                        <select id="uf-select" class="form-control" name="uf">
                                            <option @if(old('uf')=='PE' ) selected @endif value="PE">PE</option>
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
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Cadastrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stack('scripts')
@endsection