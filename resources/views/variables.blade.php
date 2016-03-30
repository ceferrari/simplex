@extends('layouts.main')

@section('content')
    <div class="form well text-center">
        {!! Form::open(array('' => '')) !!}

        <h2><b>Função:</b></h2>
        <div class="form-inline">

            @for($i = 1; $i <= $variaveis; $i++)
                <div class="form-group">
                    <label for="{{ 'X'.$i }}" class="sr-only"></label>
                    <div class="input-group">
                        <input id="{{ 'X'.$i }}" class="form-control" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        <div class="input-group-addon">{{ 'X'.$i }}</div>
                    </div>
                    @if ($i < $variaveis)
                        +
                    @endif
                </div>
            @endfor

        </div>

        <h2><b>Restrições:</b></h2>
        @for($i = 1; $i <= $restricoes; $i++)
            <div class="form-inline">

                @for($j = 1; $j <= $variaveis; $j++)
                    <div class="form-group">
                        <label for="{{ 'X'.$j }}" class="sr-only"></label>
                        <div class="input-group">
                            <input id="{{ 'X'.$j }}" class="form-control" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            <div class="input-group-addon">{{ 'X'.$j }}</div>
                        </div>
                        @if ($j < $variaveis)
                            +
                        @else
                            {!! Form::select('operador', ['menor' => '<=', 'maior' => '>=', 'igual' => '=='], null, ['class' => 'form-control']) !!}
                        @endif
                    </div>
                @endfor

                <label for="{{ 'X'.$j }}" class="sr-only"></label>
                <input id="{{ 'X'.$j }}" class="form-control" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57">

            </div>
        @endfor
  
        <div class="form-group row">
            <div class="col-sm-offset-5 col-sm-2">
                <h3>
                    {!! Form::submit('Enviar', ['class' => 'btn btn-lg btn-block btn-primary']) !!}
                </h3>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@stop