@extends('layouts.main')

@section('content')
{!! Form::open(['action' => 'HomeController@postSettings', 'class' => 'form-horizontal']) !!}
    <h2><b>Definições</b></h2>
    <hr class="divider">
    <div class="form-group">
        <h4>
            <label for="variables" class="control-label">Número de variáveis:</label>
        </h4>
        <div class="col-md-2 col-md-offset-5 col-xs-8-settings">
            <input type="number" name="variables" id="variables" class="form-control" value="1" min="1" max="20" required>
        </div>
    </div>
    <div class="form-group">
        <h4>
            <label for="variables" class="control-label">Número de restrições:</label>
        </h4>
        <div class="col-md-2 col-md-offset-5 col-xs-8-settings">
            <input type="number" name="constraints" id="constraints" class="form-control" value="1" min="1" max="20" required>
        </div>
    </div>
    <div class="form-group">
        <h4>
            <label for="variables" class="control-label">Número máximo de iterações:</label>
        </h4>
        <div class="col-md-2 col-md-offset-5 col-xs-8-settings">
            <input type="number" name="iterations" id="iterations" class="form-control" value="50" min="1" max="999" required>
        </div>
    </div>
    <div class="form-group" data-toggle="buttons" id="objectives">
        <h4>
            <label for="objective" class="control-label">Objetivo:</label>
        </h4>
        <input type="hidden" name="objective" id="objective" value="maximize" />
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
    <div class="form-group row parent">
        <div class="col-xs-8 col-sm-4 col-sm-offset-4 col-md-2 col-md-offset-5">
            <button type="submit" class="btn btn-primary btn-block" id="proximo">
                Próximo&nbsp;&nbsp;
                <span class="glyphicon glyphicon-step-forward" aria-hidden="true"></span>
            </button>
        </div>
    </div>
{!! Form::close() !!}
@stop
