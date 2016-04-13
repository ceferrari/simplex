<div class="form text-center">
    {!! Form::open(['action' => 'HomeController@table']) !!}

    <input type="hidden" name="variables" value="{{ $variables }}">
    <input type="hidden" name="constraints" value="{{ $constraints }}">
    <input type="hidden" name="iterations" value="{{ $iterations }}">

    <h3><b>Função:</b></h3>
    <div class="form-inline">

        @for($v = 1; $v <= $variables; $v++)
            <div class="form-group-inline">
                <label for="{{ 'x'.$v }}" class="sr-only"></label>
                <div class="input-group">
                    <input name="{{ 'x'.$v }}" class="form-control" type="text" required>
                    <div class="input-group-addon"><b>{{ 'x'.$v }}</b></div>
                </div>
                @if ($v < $variables)
                    +
                @endif
            </div>
        @endfor

    </div>

    <hr class="divider">
    <h3><b>Restrições:</b></h3>
    @for($r = 1; $r <= $constraints; $r++)
        <div class="form-inline">

            @for($v = 1; $v <= $variables; $v++)
                <div class="form-group-inline">
                    <label for="{{ 'r'.$r.'x'.$v }}" class="sr-only"></label>
                    <div class="input-group">
                        <input name="{{ 'r'.$r.'x'.$v }}" class="form-control" type="text" required>
                        <div class="input-group-addon"><b>{{ 'x'.$v }}</b></div>
                    </div>
                    @if ($v < $variables)
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
                    <input name="{{ 'b'.$r }}" class="form-control" type="text" required>
                </div>
            </div>

        </div>
    @endfor

    <div class="form-inline">
        <h4>
            @for($v = 1; $v <= $variables; $v++)
                {{ 'x'.$v }}
                @if ($v < $variables)
                    ,
                @endif
            @endfor
            >= 0
        </h4>
    </div>

    @include('partials.buttons')

    {!! Form::close() !!}
</div>
