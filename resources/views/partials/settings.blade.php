<div class="form-horizontal">
    {!! Form::open(['action' => 'HomeController@variables']) !!}

    <h2><b>Definições</b></h2>
    <hr class="divider">

    <div class="form-group">
        <h4>
            <label for="variables" class="control-label col-md-5 col-md-offset-2">Número de variáveis:</label>
        </h4>
        <div class="col-md-1">
            <input type="number" name="variables" id="variables" class="form-control" value="1" min="1" max="20" required>
        </div>
    </div>
    <div class="form-group">
        <h4>
            <label for="variables" class="control-label col-md-5 col-md-offset-2">Número de restrições:</label>
        </h4>
        <div class="col-md-1">
            <input type="number" name="constraints" id="constraints" class="form-control" value="1" min="1" max="20" required>
        </div>
    </div>
    <div class="form-group">
        <h4>
            <label for="variables" class="control-label col-md-5 col-md-offset-2">Número máximo de iterações:</label>
        </h4>
        <div class="col-md-1">
            <input type="number" name="iterations" id="iterations" class="form-control" value="10" min="1" max="20" required>
        </div>
    </div>
    <div class="form-group btn-group" data-toggle="buttons">
        <h4 class="btn btn-default btn-lg active">
            <input type="radio" name="maximizar" id="maximizar" autocomplete="off" checked>Maximizar
        </h4>
        <h4 class="btn btn-default btn-lg">
            <input type="radio" name="minimizar" id="minimizar" autocomplete="off">Minimizar
        </h4>
    </div>

    <hr class="divider">
    <div class="form-group">
        <div class="col-md-2 col-md-offset-5">
            <button type="submit" class="btn btn-primary btn-block" id="proximo">
                Próximo&nbsp;&nbsp;
                <span class="glyphicon glyphicon-step-forward" aria-hidden="true"></span>
            </button>
        </div>
    </div>

    {!! Form::close() !!}
</div>
