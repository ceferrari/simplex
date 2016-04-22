<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMPLEX</title>
    <meta name="description" content="Método Simplex, em Duas Fases e com Análise de Sensibilidade">
    <meta name="keywords" content="simplex">
    <meta name="author" content="Carlos Eduardo Ferrari">
    @include('partials.styles')
</head>
<body>
    <main>
        <div class="jumbotron text-center vertical-center">
            <div class="container">
                <div class="row">
                    <h1>Simplex / Duas Fases / Análise de Sensibilidade</h1>
                    <div class="thumbnail">
                        @yield('content')
                    </div>
                    <h6 class="col-md-6 col-sm-3 col-xs-4 text-left"><b>Copyright © 2016</b></h6>
                    <h6 class="col-md-6 col-sm-9 col-xs-8 text-right"><b>by Carlos Ferrari, Cíntia Akutagawa e Nathalia Yokota</b></h6>
                </div>
            </div>
        </div>
    </main>
    @include('partials.scripts')
</body>
</html>
