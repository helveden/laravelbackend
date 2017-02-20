<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{!! asset('/public/css/normalize.css') !!}">
        <link rel="stylesheet" href="{!! asset('/public/css/bootstrap.css') !!}">
        <link rel="stylesheet" href="{!! asset('/public/css/font-awesome.min.css') !!}">
        <link rel="stylesheet" href="{!! asset('/public/css/style.css') !!}">
        <link rel="stylesheet" href="{!! asset('/public/vendor/highlight/styles/monokai-sublime.css') !!}">
    </head>
    <body>
        @yield('body')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="{!! asset('/public/js/bootstrap.min.js') !!}"></script>
        <script src="{!! asset('/public/vendor/highlight/highlight.pack.js') !!}"></script>
        @yield('js')
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </body>
</html>