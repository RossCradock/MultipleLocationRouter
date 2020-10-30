<!DOCTYPE html>
<html id="html" lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height: 134%;">
    <head >
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="
        Find multiple commute times and routes when renting or buying a new house.
        Choose the different workplaces for you and your housemates and see the how long it takes to get to work. 
        Check different house locations by just changing the home address and see the new commutes.
        ">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('favicon_package/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('favicon_package/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('favicon_package/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ URL::asset('favicon_package/site.webmanifest') }}">
        <link rel="mask-icon" href="{{ URL::asset('favicon_package/safari-pinned-tab.svg') }}" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        <meta name=”robots” content="index, nofollow">
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Quicksand:400" rel="stylesheet">
        <title>My Housemates Commute</title>
    </head>
    <body style="background-image: linear-gradient(#FFF9F6, #F3FAEC); " class="container-fluid p-0">
        <div class="p-3 pt-4 border-bottom" style="background-color: #FAFAFA">
            <h1 class="m-0 text-center" style="color: 0A0A0A; font-family: Quicksand">my housemates commute</h1>
        </div>
        <div class="container-fluid pl-4 pr-4">
            @yield('content')
            @yield('scripts')
        </div>
    </body>
</html>