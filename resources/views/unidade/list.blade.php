@extends('layout.app')

@section('content')

<div class="container">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Lat</th>
                <th>Lng</th>
                <th>Opcoes</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($unds as $und)
            <tr>
                <td>{{$und->id}}</td>
                <td>{{$und->nome}}</td>
                <td>{{$und->lat}}</td>
                <td>{{$und->lng}}</td>
                <td>
                    <div class="d-flex justify-content-between flex-wrap">
                        <a class="link" href="#">
                            <span data-feather="slash"></span>
                        </a>
                        <a href="{{action('UnidadeController@editForm', $und->id)}}">
                            sdfsd
                            <i data-feather="airplay"></i>
                        </a>

                        <i data-feather="airplay"></i>

                        <form class="form-soft" action="{{action('UnidadeController@delete', $und->id)}}" method="post">
                            <button type="submit" value="Delete">aaa</button>
                            @method('delete')
                            @csrf
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@stop