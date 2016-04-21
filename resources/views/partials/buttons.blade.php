<hr class="divider">
<div class="form-group row">
    <div class="col-md-2 col-md-offset-2">
        <a href="#" onclick="history.back();return false;" class="btn btn-primary btn-block" id="voltar">
            <span class="glyphicon glyphicon-step-backward" aria-hidden="true"></span>
            &nbsp;&nbsp;Voltar
        </a>
    </div>
    <div class="col-md-2">
        <a href="{{ route('home.index') }}" class="btn btn-primary btn-block" id="novo">
            <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            &nbsp;&nbsp;Novo
        </a>
    </div>
    <div class="col-md-2">
        <a href="{{ route('home.finalSolution') }}" class="btn btn-primary btn-block" id="solucao">
            Solução&nbsp;&nbsp;
            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
        </a>
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary btn-block" id="proximo">
            Próximo&nbsp;&nbsp;
            <span class="glyphicon glyphicon-step-forward" aria-hidden="true"></span>
        </button>
    </div>
</div>
