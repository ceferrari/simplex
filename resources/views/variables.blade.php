@extends('layouts.main')

@section('content')
    <div class="form text-center">
        {!! Form::open(['action' => 'HomeController@postVariables']) !!}

        <input type="hidden" name="variables" value="{{ $variables }}">
        <input type="hidden" name="constraints" value="{{ $constraints }}">

        <h3><b>Função:</b></h3>
        <div class="form-inline">
            @for($v = 1; $v <= $variables; $v++)
                <label for="{{ 'x'.$v }}" class="sr-only"></label>
                <div class="input-group">
                    <input name="{{ 'x'.$v }}" class="form-control form-control-fixed" type="text" required>
                    <div class="input-group-addon"><b>{{ 'x'.$v }}</b></div>
                </div>
                @if ($v < $variables)
                    &nbsp;&nbsp;+&nbsp;&nbsp;
                @endif
            @endfor
        </div>

        <hr class="divider">
        <h3><b>Restrições:</b></h3>
        @for($r = 1; $r <= $constraints; $r++)
            <div class="form-inline">
                @for($v = 1; $v <= $variables; $v++)
                    <label for="{{ 'r'.$r.'x'.$v }}" class="sr-only"></label>
                    <div class="input-group">
                        <input name="{{ 'r'.$r.'x'.$v }}" class="form-control form-control-fixed" type="text" required>
                        <div class="input-group-addon"><b>{{ 'x'.$v }}</b></div>
                    </div>
                    @if ($v < $variables)
                        &nbsp;&nbsp;+&nbsp;&nbsp;
                    @endif
                @endfor

                <select name="operador" class="form-control">
                    <option value="menor"><=</option>
                    <option value="maior">>=</option>
                    <option value="igual">==</option>
                </select>

                <label for="{{ 'b'.$r }}" class="sr-only"></label>
                <input name="{{ 'b'.$r }}" class="form-control form-control-fixed-b" type="text" required>
            </div>
            <hr class="mdivider" />
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
@stop
