@extends('layouts.main')

@section('content')
{!! Form::open(['action' => 'HomeController@postTable', 'class' => 'form text-center']) !!}
    <h2><b>Análise de Sensibilidade:</b></h2>
    <hr class="separator" />
    <table class="table table-hover table-sensitivity">
        <thead>
            <tr>
                <th>Recurso</th>
                <th>Valor Original</th>
                <th>Valor Excedente</th>
                <th>Preço Sombra</th>
                <th>Limite Inferior</th>
                <th>Limite Superior</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($sensitivity as $key => $row)
            <tr>
                <td><b>{!! $key !!}</b></td>
                <td>{!! implode('</td><td>', $row) !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('partials.fractions')
    @include('partials.buttons')
{!! Form::close() !!}
@stop
