@extends('layouts.main')

@section('content')
    <div class="form text-center">
        {!! Form::open(['action' => 'HomeController@postVariables']) !!}
        <input type="hidden" name="variables" value="{{ $variables }}">
        <input type="hidden" name="constraints" value="{{ $constraints }}">
        <input type="hidden" name="iterations" value="{{ $iterations }}">
        <input type="hidden" name="objective" value="{{ $objective }}">
        <input type="hidden" name="twoPhases" value="false">
        <h3><b>Função:</b></h3>
        <div class="form-inline">
            @for($i = 1; $i <= $variables; $i++)
                <label for="{{ 'table[z][x'.$i.']' }}" class="sr-only"></label>
                <div class="input-group">
                    <input name="{{ 'table[z][x'.$i.']' }}" class="form-control form-control-fixed" type="text" required>
                    <div class="input-group-addon"><b>{{ 'x'.$i }}</b></div>
                </div>
                @if ($i < $variables)
                    &nbsp;&nbsp;+&nbsp;&nbsp;
                @endif
            @endfor
        </div>
        <hr class="divider">
        <h3><b>Restrições:</b></h3>
        @for($i = 1; $i <= $constraints; $i++)
            <div class="form-inline">
                @for($j = 1; $j <= $variables; $j++)
                    <label for="{{ 'table[f'.$i.'][x'.$j.']' }}" class="sr-only"></label>
                    <div class="input-group">
                        <input name="{{ 'table[f'.$i.'][x'.$j.']' }}" class="form-control form-control-fixed" type="text" required>
                        <div class="input-group-addon"><b>{{ 'x'.$j }}</b></div>
                    </div>
                    @if ($j < $variables)
                        &nbsp;&nbsp;+&nbsp;&nbsp;
                    @endif
                @endfor
                <select name="{{ 'operators['.$i.']' }}" class="form-control operator">
                    <option value="less"><=</option>
                    <option value="greater">>=</option>
                    <option value="equal">==</option>
                </select>
                <label for="{{ 'table[f'.$i.'][B]' }}" class="sr-only"></label>
                <input name="{{ 'table[f'.$i.'][B]' }}" class="form-control form-control-fixed-b" type="text" required>
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
