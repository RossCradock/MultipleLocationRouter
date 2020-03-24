<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
});


Route::get('/routes', function () {
    $endpoint = "http://my.domain.com/test.php";
    $client = new \GuzzleHttp\Client();
    $id = 5;
    $value = "ABC";
    
    $response = $client->request('GET', $endpoint, ['query' => [
        'key1' => $id,
        'key2' => $value,
    ]]);
    
    // url will be: http://my.domain.com/test.php?key1=5&key2=ABC;
	// https://maps.googleapis.com/maps/api/directions/json?origin=Disneyland&destination=Universal+Studios+Hollywood&key=AIzaSyCpkl1_uMbaYXhIxJDvmegCswA9Tf3F69U
    
    $statusCode = $response->getStatusCode();
    $content = $response->getBody();
    return view('routes');
});
