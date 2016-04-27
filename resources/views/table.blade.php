@extends('layouts.main')

@section('content')
{!! Form::open(['action' => 'HomeController@postTable', 'class' => 'form text-center']) !!}
    <h2><b>Tabela:</b></h2>
    <hr class="separator" />
    <table class="table table-hover table-table">
        <thead>
            <tr>
                <th>Base</th>
                <th>{!! implode('</th><th>', array_keys(current($table))) !!}</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($table as $key => $row)
            <tr>
                <td><b>{!! $key !!}</b></td>
                <td>{!! implode('</td><td>', $row) !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <input type="hidden" name="twoPhases" value="{{ Session::get('twoPhases') }}">
    @include('partials.checkboxes')
    @include('partials.buttons')
{!! Form::close() !!}
@stop
