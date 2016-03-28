<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Simplex</title>
        <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="vertical-center">
        <div class="container">

            <div class="well text-center">
                <h1>SIMPLEX by Carlos Eduardo Ferrari</h1>
            </div>

            <div class="form-horizontal well">
                {!! Form::open(array('url' => 'foo/bar')) !!}

                <div class="form-group">
                    <h3>
                        {!! Form::label('variaveis', 'Informe o número de variáveis:', ['class' => 'control-label col-sm-offset-2 col-sm-5']) !!}
                    </h3>
                    <div class="col-sm-2">
                        {!! Form::number('variaveis', null, ['class' => 'form-control input-lg', 'id' => 'variaveis']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <h3>
                        {!! Form::label('restricoes', 'Informe o número de restrições:', ['class' => 'control-label col-sm-offset-2 col-sm-5']) !!}
                    </h3>
                    <div class="col-sm-2">
                        {!! Form::number('restricoes', null, ['class' => 'form-control input-lg', 'id' => 'restricoes']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-2">
                        <h3>
                            {!! Form::submit('Enviar', ['class' => 'btn btn-lg btn-block btn-primary']) !!}
                        </h3>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>

        </div>

        <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    </body>

</html>