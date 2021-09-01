<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Eros</title>

        <link rel="stylesheet" href="{{mix('css/plugins.css')}}">
        <link rel="stylesheet" href="{{mix('css/app.css')}}">

        @stack('link')

    </head>
    <body>
        @include('includes.loading')
        @include('includes.header')
        @yield('content')
        @include('includes.footer')
        @stack('js')
        <script>
            const PATH = "{{url('/')}}"+"/";
        </script>
        <script src="{{mix('js/app.js')}}"></script>
    </body>
</html>
