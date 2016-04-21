@extends('layouts.main')

@section('content')
    <div class="form text-center">
        {!! Form::open(['action' => 'HomeController@postTable']) !!}

        <h2><b>Tabela:</b></h2>
        <hr class="separator" />
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Base</th>
                    <th>{!! implode('</th><th>', array_keys(current($table))) !!}</th>
                </tr>
          </thead>
          <tbody>
              @foreach ($table as $key => $row)
                  <tr>
                      <td><b>{!! $key !!}</b></td>
                      <td class="val">{!! implode('</td><td>', $row) !!}</td>
                  </tr>
              @endforeach
          </tbody>
        </table>

        <h2 class="btn-group" data-toggle="buttons">
            <label class="btn btn-default" id="toFractions">
                <input type="checkbox" autocomplete="off"><b>Exibir valores como frações</b>
            </label>
        </h2>

        <h5><b>X</b> = Variável de Decisão, <b>F</b> = Variável de Folga, <b>E</b> = Variável de Excesso, <b>A</b> = Variável Artifical</h5>

        @include('partials.buttons')

        {!! Form::close() !!}
    </div>
@stop
