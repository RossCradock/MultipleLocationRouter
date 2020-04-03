<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        <title>{{config('app.name', 'MultipleLocationRouter')}}</title>
    </head>
    @include('includes.nav')
    <body class="container-fluid">
        <div class="container-fluid">
            @yield('content')
            @yield('scripts')
        </div>
    </body>
</html>