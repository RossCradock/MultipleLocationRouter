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