@extends('layouts.main')

@section('content')
<div class="form-horizontal">
    {!! Form::open(['action' => 'HomeController@postSettings']) !!}

    <h2><b>Definições</b></h2>
    <hr class="divider">

    <div class="form-group">
        <h4>
            <label for="variables" class="control-label">Número de variáveis:</label>
        </h4>
        <div class="col-md-2 col-md-offset-5">
            <input type="number" name="variables" id="variables" class="form-control" value="1" min="1" max="20" required>
        </div>
    </div>
    <div class="form-group">
        <h4>
            <label for="variables" class="control-label">Número de restrições:</label>
        </h4>
        <div class="col-md-2 col-md-offset-5">
            <input type="number" name="constraints" id="constraints" class="form-control" value="1" min="1" max="20" required>
        </div>
    </div>
    <div class="form-group">
        <h4>
            <label for="variables" class="control-label">Número máximo de iterações:</label>
        </h4>
        <div class="col-md-2 col-md-offset-5">
            <input type="number" name="iterations" id="iterations" class="form-control" value="10" min="1" max="20" required>
        </div>
    </div>
    <div class="form-group btn-group mtop" data-toggle="buttons" id="operations">
        <input type="hidden" name="operation" id="operation" value="maximize" />
        <h4 class="btn btn-default">
            <input type="radio" value="minimize" autocomplete="off"><b>&nbsp;&nbsp;Minimizar&nbsp;&nbsp;</b>
        </h4>
        {{-- <h4 class="btn btn-default">
            <input type="radio" value="sensitivity" autocomplete="off"><b>Sensibilidade</b>
        </h4> --}}
        <h4 class="btn btn-default active">
            <input type="radio" value="maximize" autocomplete="off"><b>&nbsp;&nbsp;Maximizar&nbsp;&nbsp;</b>
        </h4>
    </div>

    <hr class="divider">
    <div class="form-group">
        <div class="col-md-2 col-md-offset-5">
            <button type="submit" class="btn btn-primary btn-block" id="proximo">
                Próximo&nbsp;&nbsp;
                <span class="glyphicon glyphicon-step-forward" aria-hidden="true"></span>
            </button>
        </div>
    </div>

    {!! Form::close() !!}
</div>
@stop
