<div class="form thumbnail text-center">
    {!! Form::open(['action' => 'HomeController@table']) !!}

    <input type="hidden" name="variaveis" value="{{ $variaveis }}">
    <input type="hidden" name="restricoes" value="{{ $restricoes }}">

    <h3><b>Função:</b></h3>
    <div class="form-inline">

        @for($v = 1; $v <= $variaveis; $v++)
            <div class="form-group-inline">
                <label for="{{ 'x'.$v }}" class="sr-only"></label>
                <div class="input-group">
                    <input name="{{ 'x'.$v }}" class="form-control" type="text">
                    <div class="input-group-addon"><b>{{ 'x'.$v }}</b></div>
                </div>
                @if ($v < $variaveis)
                    +
                @endif
            </div>
        @endfor

    </div>

    <hr class="divider">
    <h3><b>Restrições:</b></h3>
    @for($r = 1; $r <= $restricoes; $r++)
        <div class="form-inline">

            @for($v = 1; $v <= $variaveis; $v++)
                <div class="form-group-inline">
                    <label for="{{ 'r'.$r.'x'.$v }}" class="sr-only"></label>
                    <div class="input-group">
                        <input name="{{ 'r'.$r.'x'.$v }}" class="form-control" type="text">
                        <div class="input-group-addon"><b>{{ 'x'.$v }}</b></div>
                    </div>
                    @if ($v < $variaveis)
                        +
                    @endif
                </div>
            @endfor

            <select name="operador" class="form-control">
                <option value="menor"><=</option>
                <option value="maior">>=</option>
                <option value="igual">==</option>
            </select>
            <div class="form-group-inline">
                <label for="{{ 'b'.$r }}" class="sr-only"></label>
                <div class="input-group">
                    <input name="{{ 'b'.$r }}" class="form-control" type="text">
                </div>
            </div>

        </div>
    @endfor

    <h4 class="form-inline">
        @for($v = 1; $v <= $variaveis; $v++)
            {{ 'x'.$v }}
            @if ($v < $variaveis)
                ,
            @endif
        @endfor
        >= 0
    </h4>

    <hr class="divider">
    <div class="form-group row">
        <div class="col-sm-2 col-sm-offset-3">
            <button type="button" class="btn btn-default btn-block">
                <span class="glyphicon glyphicon-step-backward" aria-hidden="true"></span>
                Voltar
            </button>
        </div>
        <div class="col-sm-2">
            <button type="button" class="btn btn-default btn-block">
                <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                Novo
            </button>
        </div>
        <div class="col-sm-2">
            <button type="submit" class="btn btn-default btn-block">
                Próximo
                <span class="glyphicon glyphicon-step-forward" aria-hidden="true"></span>
            </button>
        </div>
    </div>

    {!! Form::close() !!}
</div>
