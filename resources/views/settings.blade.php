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
        <div class="form-group" data-toggle="buttons" id="operations">
            <h4>
                <label for="operation" class="control-label">Operação:</label>
            </h4>
            <input type="hidden" name="operation" id="operation" value="maximize" />
            <div class="btn-group">
                <label class="btn btn-default">
                    <input type="radio" value="minimize" autocomplete="off"><b>&nbsp;&nbsp;Minimizar&nbsp;&nbsp;</b>
                </label>
                <label class="btn btn-default active">
                    <input type="radio" value="maximize" autocomplete="off"><b>&nbsp;&nbsp;Maximizar&nbsp;&nbsp;</b>
                </label>
            </div>
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
