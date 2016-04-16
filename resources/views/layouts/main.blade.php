<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMPLEX</title>
    @include('partials.styles')
</head>
<body>
    <main>
        <div class="jumbotron text-center vertical-center">
            <div class="container">
                <div class="row">
                    <div class="thumbnail">
                        @yield('content')
                    </div>
                    <h6 class="text-right"><b>SIMPLEX by Carlos Ferrari, Cíntia Akutagawa e Nathalia Yokota</b></h6>
                </div>
            </div>
        </div>
    </main>
    @include('partials.scripts')
</body>
</html>
