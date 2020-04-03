@extends('layouts.app')
@section('content')
<div class="row">
    <div id="locations" class="col-6"> 
        <div id="homeLocation"> 
            @include('includes.homeLocation')
            <div id="workplaceAndRoutes" class="container-fluid justify-content-center h-100">
                <div class="row justify-content-center">
                    <div id="workplace" class="col-6 p-2">
                        @include('includes.workplace')
                    </div>
                    <div id="route" class="col-6 p-2">
                        @include('includes.route')
                    </div>
                </div>
                <div class="row">
                    <button type="button" class="btn btn-primary p-2 mt-4 m-2 justify-content-center flex-grow-1">Add Workplace +</button>
                </div>
            </div>
        </div>
    </div>
    <div id="map" class="col-6">
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
    Get lat long for entered address
        https://developers.google.com/maps/documentation/javascript/places-autocomplete
        •address search bar
        Use the above to get lat long for setMarker()
        •Autocomplete is still not off for some reason
    
    Set up integration functions
        need a listener for address picked which updates the setMarker 
        need a listener for time picked
        need to have some logic for when the above 2 listeners so that route is updated OR need to add a button called set workplace
   
    Set up map and marker functions
        https://developers.google.com/maps/documentation/javascript/adding-a-google-map
        https://stackoverflow.com/questions/3059044/google-maps-js-api-v3-simple-multiple-marker-example
        split the above into 2 separate functions
            •one for initialiseing the map view and setting no marker just zoom on london ** mapInit()
            then another that takes in an argument of a marker position ** setMarker(lat, long)
                have the marker of home marked different to the others

    https://developers.google.com/maps/documentation/distance-matrix/intro 
        Set up routes api
        Set up routes card

    Add another workplace button
        needs to create another workplace card and route card

    Calculate costs and gains for putting in ads and setting it live
        money made from ads - google maps api - aws costs

    Add in an adds banner down the bottom

    Add in some kind of rate limiting

    Have a dns set up for it

    Set up meta data for robots and search
--}}