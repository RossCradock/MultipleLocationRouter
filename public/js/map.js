var autocomplete_homelocation;

function initMap(){
    var london_bridge_coordinates = new google.maps.LatLng(51.508, -0.093);
    var map = new google.maps.Map(document.getElementById('address-map'), {
    center: london_bridge_coordinates,
    zoom: 12
    });

    // autocomplete search
    var input_homelocation = document.getElementById('pac-input-homelocation');
    var input_workplace = document.getElementById('pac-input-workplace');
    autocomplete_homelocation = new google.maps.places.Autocomplete(input_homelocation, {types: ['geocode']});
    var autocomplete_workplace = new google.maps.places.Autocomplete(input_workplace);
    autocomplete_homelocation.setFields(['address_component']);
    autocomplete_homelocation.addListener('place_changed', fillInAddress);
}

function fillInAddress(){
    var place = autocomplete_homelocation.getPlace();
    console.log(place);
}