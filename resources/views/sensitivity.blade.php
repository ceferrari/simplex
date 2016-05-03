@extends('layouts.main')

@section('content')
{!! Form::open(['action' => 'HomeController@postTable', 'class' => 'form text-center']) !!}
    <h2><b>Análise de Sensibilidade:</b></h2>
    <hr class="separator" />
    @if (Session::get('solutionType') == 'optimal')
    <table class="table table-hover table-sensitivity">
        <thead>
            <tr>
                <th>Variável</th>
                <th>Valor Original</th>
                <th>Valor Excedente</th>
                <th>Custo Reduzido</th>
                <th>Custo Mínimo</th>
                <th>Custo Máximo</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($sensitivity['variables'] as $key => $row)
            <tr>
                <td><b>{!! $key !!}</b></td>
                <td>{!! implode('</td><td>', $row) !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if (isset($sensitivity['restrictions']))
    <table class="table table-hover table-sensitivity">
        <thead>
            <tr>
                <th>Restrição</th>
                <th>Valor Original</th>
                <th>Valor Excedente</th>
                <th>Preço Sombra</th>
                <th>Limite Inferior</th>
                <th>Limite Superior</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($sensitivity['restrictions'] as $key => $row)
            <tr>
                <td><b>{!! $key !!}</b></td>
                <td>{!! implode('</td><td>', $row) !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
    @include('partials.checkboxes')
    @else
    <h2>Não é possível realizar a Análise de Sensibilidade para este problema, pois não possui uma solução ótima.</h2>
    @endif
    @include('partials.buttons')
{!! Form::close() !!}
@stop
