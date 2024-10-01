<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">
    <link href=" {{ url('css/bootstrap.min.css') }} " rel="stylesheet">
</head>

<body class="body">
    @if(session()->has('feedback.message'))
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="alert_correcto ">
                        {!! session()->get('feedback.message') !!}
                    </div>
                </div>
            </div>
        </div>
    @endif

    @yield('content')

    <!-- Scripts de Bootstrap -->
    <script src="{{ url('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>