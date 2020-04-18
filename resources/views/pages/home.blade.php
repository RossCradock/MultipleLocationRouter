@extends('layouts.app')
@section('content')
<div class="row pl-4 pr-4">
    <div id="locations" class="col-6"> 
        <div id="homeLocation"> 
            @include('includes.homeLocation')
            <div id="workplaceAndRoute" class="container-fluid justify-content-center">
                <div class="row justify-content-center">
                    <div id="workplace" class="col-6 p-2">
                        <h2>workplace</h2>
                        @include('includes.workplace', ['workplaceNo' => '0'])
                    </div>
                    <div id="route" class="col-6 p-2 d-flex">
                        <div class="container-fluid d-flex flex-column">
                            <h2 class="row">route</h2>
                            <div class="row flex-fill d-flex">
                                @include('includes.route', ['workplaceNo' => '0'])
                            </div>
                        </div>
                    </div>
                </div>
                <div id="workplaceAndRoute1" style="display: none" class="row justify-content-center">
                    <div id="workplace1" class="col-6 p-2">
                        @include('includes.workplace', ['workplaceNo' => '1'])
                    </div>
                    <div id="route1" class="col-6 p-2 d-flex">
                        <div class="container-fluid d-flex flex-column">
                            <div class="row flex-fill d-flex">
                                @include('includes.route', ['workplaceNo' => '1'])
                            </div>
                        </div>
                    </div>
                </div>
                <div id="workplaceAndRoute2" style="display: none" class="row justify-content-center">
                    <div id="workplace1" class="col-6 p-2">
                        @include('includes.workplace', ['workplaceNo' => '2'])
                    </div>
                    <div id="route1" class="col-6 p-2 d-flex">
                        <div class="container-fluid d-flex flex-column">
                            <div class="row flex-fill d-flex">
                                @include('includes.route', ['workplaceNo' => '2'])
                            </div>
                        </div>
                    </div>
                </div>
                <div id="workplaceAndRoute3" style="display: none" class="row justify-content-center">
                    <div id="workplace1" class="col-6 p-2">
                        @include('includes.workplace', ['workplaceNo' => '3'])
                    </div>
                    <div id="route1" class="col-6 p-2 d-flex">
                        <div class="container-fluid d-flex flex-column">
                            <div class="row flex-fill d-flex">
                                @include('includes.route', ['workplaceNo' => '3'])
                            </div>
                        </div>
                    </div>
                </div>
                <div id="workplaceAndRoute4" style="display: none" class="row justify-content-center">
                    <div id="workplace1" class="col-6 p-2">
                        @include('includes.workplace', ['workplaceNo' => '4'])
                    </div>
                    <div id="route1" class="col-6 p-2 d-flex">
                        <div class="container-fluid d-flex flex-column">
                            <div class="row flex-fill d-flex">
                                @include('includes.route', ['workplaceNo' => '4'])
                            </div>
                        </div>
                    </div>
                </div>
                <div id="addWorkplaceButton" class="row">
                    <button type="button" onclick="addWorkplace()" class="btn btn-primary p-2 mt-4 m-2 justify-content-center flex-grow-1">Add Workplace +</button>
                </div>
            </div>
        </div>
    </div>
    <div id="map" class="col-6" style="position: fixed; right: 20px">
        <h2 style="visibility: hidden">home</h2>
        @include('includes.map')
    </div>
</div>
@endsection

@section('scripts')
    @parent
    <script src="{{ URL::asset('js/map.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap"
    async defer></script>
@stop

{{-- 
TODO
    •might need to change these into one big js file
    •Get lat long for entered address
        https://developers.google.com/maps/documentation/javascript/places-autocomplete
        •address search bar
        •Use the above to get lat long for setMarker()
        •Autocomplete is still not off for some reason
    
    Set up integration functions
        •need a listener for address picked which updates the setMarker 
        •need a listener for time picked
        •need to have some logic for when the above 2 listeners so that route is updated OR need to add a button called set workplace
   
    Set up map and marker functions
        https://developers.google.com/maps/documentation/javascript/adding-a-google-map
        https://stackoverflow.com/questions/3059044/google-maps-js-api-v3-simple-multiple-marker-example
        •split the above into 2 separate functions
            •one for initialiseing the map view and setting no marker just zoom on london ** mapInit()
            •then another that takes in an argument of a marker position ** setMarker(lat, long)
                •have the marker of home marked different to the others
            •resize map to be able to see all markers

    https://developers.google.com/maps/documentation/distance-matrix/intro 
        •Set up routes api
        •Set up routes card

    https://stackoverflow.com/questions/29481300/plot-polyline-in-google-maps
        •set up polylines
        •set up routes to have different colours
        •set routes to be removed in all circumstances when needed
            •overwritten in place time transport mode and new home location

    Add another workplace button
        •needs to create another workplace card and route card
    
    set up routes timings
        •driving commute time based on departure being 30mins before arrival time
            •commute time will need some work on how its displayed
            •departure time will be max time
        •transit commute can have arrival time
        •transit with just walking throws cannot read property value undefined. Need to error handle this to look for another duration or arrival time value
        •departure time shows no zero, might a parse int issue
        
    •might need to have a tick box for setting the transit labels
    
    •update to new home location

    https://coolors.co/d6a2ad-c3b59f-a0af84-668f80-4a6670
        •need to have markers the same colour as the route and remove the number as well
        •background colour needs to be changed
        •change the H colour to white or something else
        •text for times needs to be changed
        •nav bar needs to be changed maybe with a logo
            •top div for name off-white

    meta data
        need to figure out where i put in meta tag to be involved in seo results 
        need to write up meta data

    Calculate costs and gains for putting in ads and setting it live
        money made from ads - google maps api - aws costs

    Add in an adds banner down the bottom

    Add in some kind of rate limiting

    Have a dns set up for it
        newhomecommutefinder
        homecommutefinder
        householdcommute
        housematescommutecalulator
        housematecommutecalulator
        housematesnewcommute
        myhousematescommute
        ournewhomecommute
        ournewhousecommute
        housecommutefinder

        commute house/home / rent / trip


    Set up meta data for robots and search
--}}