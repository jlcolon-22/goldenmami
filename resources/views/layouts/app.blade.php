<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="{{asset('logo/logo.png')}}" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&display=swap" rel="stylesheet">

        <link href="" rel="stylesheet">
        <title>Golden Mami</title>
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
         <link rel="stylesheet" href="{{asset('css/style.css')}}">

        <style>
            *{
                font-family: 'futura','sans';
            }
        </style>
        <style>
        #map > .gmnoprint {
       display:none !important;
}
</style>
    </head>
    <body class="scroll-smooth">
        <div id="app">
            @yield('content')
        </div>
        <script src="{{mix('js/app.js')}}"></script>
        @yield('scripts')
    </body>
</html>
