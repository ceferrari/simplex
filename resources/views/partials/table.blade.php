<div class="form thumbnail text-center">
    {!! Form::open(['action' => 'HomeController@table']) !!}



    <h3><b>Tabela:</b></h3>
    <?php if (count($tabela) > 0): ?>
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th><?php echo implode('</th><th>', array_keys(current($tabela))); ?></th>
            </tr>
      </thead>
      <tbody>
          <?php foreach ($tabela as $row): array_map('htmlentities', $row); ?>
              <tr>
                  <td><?php echo implode('</td><td>', $row); ?></td>
              </tr>
          <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>


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
