@extends('layouts.main')

@section('content')
    <div class="form-horizontal well">
        {!! Form::open(array('' => '')) !!}

        <div class="form-group">
            <h3>
                {!! Form::label('variaveis', 'Informe o número de variáveis:', ['class' => 'control-label col-sm-offset-2 col-sm-5']) !!}
            </h3>
            <div class="col-sm-2">
                {!! Form::number('variaveis', null, ['class' => 'form-control input-lg', 'id' => 'variaveis']) !!}
            </div>
        </div>
        <div class="form-group">
            <h3>
                {!! Form::label('restricoes', 'Informe o número de restrições:', ['class' => 'control-label col-sm-offset-2 col-sm-5']) !!}
            </h3>
            <div class="col-sm-2">
                {!! Form::number('restricoes', null, ['class' => 'form-control input-lg', 'id' => 'restricoes']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-5 col-sm-2">
                <h3>
                    {!! Form::submit('Enviar', ['class' => 'btn btn-lg btn-block btn-primary']) !!}
                </h3>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@stop