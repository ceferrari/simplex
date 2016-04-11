<div class="form thumbnail text-center">
    {!! Form::open(['action' => 'HomeController@solution']) !!}

    <h3><b>Solução:</b></h3>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Base</th>
                <th>{!! implode('</th><th>', array_keys(current($tabela))) !!}</th>
            </tr>
      </thead>
      <tbody>
          @foreach ($tabela as $key => $row)
              <tr>
                  <td><b>{!! $key !!}</b></td>
                  <td>{!! implode('</td><td>', $row) !!}</td>
              </tr>
          @endforeach
      </tbody>
    </table>

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
