@extends('layouts.main')

@section('content')
{!! Form::open(['action' => 'HomeController@postSolution', 'class' => 'form text-center']) !!}
    <h2><b>Solução:</b></h2>
    <hr class="separator" />
    @if (Session::get('hasSolution') == 'true')
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <table class="table table-hover table-bordered table-solution table-solution-right">
                <thead>
                    <tr>
                        <th colspan="2">Váriaveis Básicas</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($solution as $key => $row)
                @if ($row != 0)
                    <tr>
                        <td>{!! $key !!}</td>
                        <td>{!! $row !!}</td>
                    </tr>
                @endif
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-hover table-bordered table-solution table-solution-left">
                <thead>
                    <tr>
                        <th colspan="2">Váriaveis Não Básicas</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($solution as $key => $row)
                @if ($row == 0)
                    <tr>
                        <td>{!! $key !!}</td>
                        <td>{!! $row !!}</td>
                    </tr>
                @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('partials.fractions')
    @else
    <h2 id="noSolution">Não existe uma solução possível para o problema.</h2>
    @endif
    @include('partials.buttons')
{!! Form::close() !!}
@stop
