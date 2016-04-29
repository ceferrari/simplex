@extends('layouts.main')

@section('content')
{!! Form::open(['action' => 'HomeController@postVariables', 'class' => 'form text-center']) !!}
    <h2><b>{{ $objective == 'maximize' ? 'Maximização' : 'Minimização' }}</b></h2>
    <hr class="divider">
    <h3><b>Função:</b></h3>
    <div class="form-inline">
        @for ($i = 1; $i <= $variables; $i++)
        <label for="{{ 'table[z][x'.$i.']' }}" class="sr-only"></label>
        <div class="input-group col-xs-8-variables">
            <input name="{{ 'table[z][x'.$i.']' }}" class="form-control form-control-fixed" type="text" required>
            <div class="input-group-addon"><b>{{ 'x'.$i }}</b></div>
        </div>
        @if ($i < $variables)
        &nbsp;+&nbsp;
        @endif
        @endfor
    </div>
    <h3><b>Restrições:</b></h3>
    @for($i = 1; $i <= $constraints; $i++)
    <div class="form-inline">
        @for ($j = 1; $j <= $variables; $j++)
        <label for="{{ 'table[f'.$i.'][x'.$j.']' }}" class="sr-only"></label>
        <div class="input-group col-xs-8-variables">
            <input name="{{ 'table[f'.$i.'][x'.$j.']' }}" class="form-control form-control-fixed" type="text" required>
            <div class="input-group-addon"><b>{{ 'x'.$j }}</b></div>
        </div>
        @if ($j < $variables)
        &nbsp;+&nbsp;
        @endif
        @endfor
        <select name="{{ 'operators['.$i.']' }}" class="form-control operator col-xs-8-variables">
            <option value="less"><=</option>
            <option value="greater">>=</option>
            <option value="equal">==</option>
        </select>
        <div class="input-group col-xs-8-variables">
            <label for="{{ 'table[f'.$i.'][B]' }}" class="sr-only"></label>
            <input name="{{ 'table[f'.$i.'][B]' }}" class="form-control form-control-fixed-b" type="text" required>
        </div>
    </div>
    <hr class="mdivider" />
    @endfor
    <div class="form-inline mtop">
        <h4>
        @for ($v = 1; $v < $variables; $v++)
        {{ 'x'.$v.',' }}
        @endfor
        {{ 'x'.$v.' >= 0' }}
        </h4>
    </div>
    <input type="hidden" name="twoPhases" value="false">
    @include('partials.buttons')
{!! Form::close() !!}
@stop
