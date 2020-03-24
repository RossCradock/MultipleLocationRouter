<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        <title>{{config('app.name', 'MultipleLocationRouter')}}</title>
    </head>
    <body class="container-fluid">
        @include('includes.nav')
        <div class="container-fluid">
            @yield('content')
            @yield('scripts')
        </div>
    </body>
</html>