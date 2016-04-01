<div class="form-horizontal thumbnail text-center">
    {!! Form::open([]) !!}

    <h2><b>Definições</b></h2>

    <hr class="divider">
    <div class="form-group">
        <h4>
            {!! Form::label('variaveis', 'Número de variáveis:', ['class' => 'control-label col-sm-5 col-sm-offset-2']) !!}
        </h4>
        <div class="col-sm-1">
            {!! Form::number('variaveis', null, ['class' => 'form-control', 'id' => 'variaveis']) !!}
        </div>
    </div>
    <div class="form-group">
        <h4>
            {!! Form::label('restricoes', 'Número de restrições:', ['class' => 'control-label col-sm-5 col-sm-offset-2']) !!}
        </h4>
        <div class="col-sm-1">
            {!! Form::number('restricoes', null, ['class' => 'form-control', 'id' => 'restricoes']) !!}
        </div>
    </div>

    <hr class="divider">
    <div class="form-group">
        <div class="col-sm-2 col-sm-offset-5">
            <button type="submit" class="btn btn-default btn-block">
                Próximo
                <span class="glyphicon glyphicon-step-forward" aria-hidden="true"></span>
            </button>
        </div>
    </div>

    {!! Form::close() !!}
</div>