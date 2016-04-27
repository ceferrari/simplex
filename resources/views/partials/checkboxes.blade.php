<div class="row">
    <div class="col-xs-8 col-sm-4 col-md-3 col-xs-offset-2 col-md-offset-3">
        <input type="hidden" name="showMarkingsOn" value="{{ Session::get('showMarkings') }}" />
        <h2 class="btn-group btn-group-justified" data-toggle="buttons">
            <label class="btn btn-default" id="showMarkings">
                <input type="checkbox" name="showMarkings" autocomplete="off"><b>Exibir marcações da iteração</b>
            </label>
        </h2>
    </div>
    <div class="col-xs-8 col-sm-4 col-md-3 col-xs-offset-2 col-sm-offset-0">
        <input type="hidden" name="toFractionsOn" value="{{ Session::get('toFractions') }}" />
        <h2 class="btn-group btn-group-justified" data-toggle="buttons">
            <label class="btn btn-default" id="toFractions">
                <input type="checkbox" name="toFractions" autocomplete="off"><b>Exibir valores como frações</b>
            </label>
        </h2>
    </div>
</div>
<h5><b>X</b> = Variável de Decisão, <b>F</b> = Variável de Folga, <b>E</b> = Variável de Excesso, <b>A</b> = Variável Artifical</h5>
