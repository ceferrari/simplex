<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simplex</title>
    @include('partials.styles')
</head>
<body>
    <div class="jumbotron vertical-center">
        <div class="container">
            <div class="row">
                @yield('content')
                <h6 class="text-right"><b>SIMPLEX by Carlos Eduardo Ferrari</b></h6>
            </div>
        </div>
    </div>
    @include('partials.scripts')
</body>
</html>
