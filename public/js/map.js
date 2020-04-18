// initialise the workplace element added number to 1 as the first one already showing at the start
var workplace_element_added_number = 1;

// this variable keeps track of which workplace has last been entered
var workplace_number = 0;

// by default all of the time inputs are set
var time_set = [true, true, true, true, true];

// input elements array, empty to start with but will have 5 after script is loaded
var autocomplete_workplaces = [];

// markers array holder, element 6 is home
var markers = [null, null, null, null, null, null];

// routes holder array
var directionsRenderers = [];

var directionsService;
var colours = [
    '#6A9491', // dark aqua
    '#5F0F40', // purple
    '#C88D29', // saffron
    '#9A031E', // dark red
    '#8E8358' // tan
];

var map;
function initMap(){
    // setup map
    var london_bridge_coordinates = new google.maps.LatLng(51.507927, -0.0877726);
    map = new google.maps.Map(document.getElementById('address-map'), {
        center: london_bridge_coordinates,
        zoom: 12,
        mapTypeControl: false,
        streetViewControl: false,
        fullscreenControl: false
    });

    
    // homelocation
    var input_homelocation = document.getElementById('pac_input_homelocation');
    autocomplete_homelocation = new google.maps.places.Autocomplete(input_homelocation, {types: ['geocode']});
    autocomplete_homelocation.setFields(['address_component', 'geometry']);
    autocomplete_homelocation.addListener('place_changed', fillInHomeAddress);

    // workplace
    for (let i = 0; i <= 4; i++){
        var elementId = 'pac_input_workplace'.concat(i);
        var input_workplace = document.getElementById(elementId);
        autocomplete_workplaces[i] = new google.maps.places.Autocomplete(input_workplace, {types: ['geocode']});
        autocomplete_workplaces[i].setFields(['geometry']);
        autocomplete_workplaces[i].addListener('place_changed', fillInWorkplaceAddress);
    }

    // set up routes services
    directionsService = new google.maps.DirectionsService();
}

var autocomplete_homelocation;
var marker_homelocation = null;
function fillInHomeAddress(){
    var place = autocomplete_homelocation.getPlace();
    
    // address
    var home_address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || ''),
    ].join(' ');
    
    // postcode
    var no_of_address_components = place.address_components.length - 1
    var home_postcode = (place.address_components[no_of_address_components] 
                         && place.address_components[no_of_address_components].short_name 
                         || '');
    document.getElementById('address_line').innerHTML = home_address;
    document.getElementById('postcode').innerHTML = home_postcode;

    // get home location lat long and add marker
    var marker = new google.maps.Marker({
        position: place.geometry.location,
        title: 'Home'
    });
    setMarker(marker, 5);

    // need to reset routing for different locations
    for (let i = 0; i <= 4; i++){
        setRouting(i);
    }
}

function fillInWorkplaceAddress(){
    var place = autocomplete_workplaces[workplace_number].getPlace();
    if (typeof place == 'undefined'){
        // no place set (empty input field or address doesn't exist)
        return;
    }
    var marker = new google.maps.Marker({
        position: place.geometry.location,
        title: 'Workplace',
        label: {
            text: '•', 
            fontSize: '28px',
            color: 'white'
        },
        icon: {
            path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z',
            fillColor: colours[workplace_number],
            fillOpacity: 1,
            strokeColor: 'white',
            strokeWeight: 1.2,
            labelOrigin: { x: 0, y: -28 }
        }
    });
    setMarker(marker, workplace_number)
    setRouting(workplace_number)

    // change hint above home location to say it can be updated when home and workplace are updated
    if (markers[5] != null){
        document.getElementById('homelocation_hint').innerHTML = 'Change home location to update routes:';
    }
}

function setMarker(marker, marker_number){
    // check if the marker is already set
    if (markers[marker_number] !== null) {
        markers[marker_number].setMap(null);
    }

    markers[marker_number] = marker;

    // change map bounds
    var bounds = new google.maps.LatLngBounds();
    var set_markers = 0;
    for (let i = 0; i < markers.length; i++) {
        if (markers[i] === null){
            continue;
        } else {
            set_markers++;
            bounds.extend(markers[i].getPosition());
        }
    }
    map.fitBounds(bounds);

    // add marker to map
    marker.setMap(map)

    // if only one marker set the zoom to be higher 
    if (set_markers <= 1) {
        map.setZoom(15);
    }
}

function timeChanged(time){
    time_set[workplace_number] = (time.length > 0);
    var time = document.getElementById('input_time'.concat(workplace_number)).value;
    setRouting(workplace_number);
}

function transportModeChanged(){
    setRouting(workplace_number);
}

function addWorkplace(){
    var nextWorkplace = document.getElementById('workplaceAndRoute'.concat(workplace_element_added_number))
    nextWorkplace.style.display = "";
    document.getElementById('workplace_color_top_border'.concat(workplace_element_added_number))
        .style.backgroundColor = colours[workplace_element_added_number];
    workplace_element_added_number++;
    if (workplace_element_added_number > 4){
        document.getElementById('addWorkplaceButton').style.display = "none";
    }
}

function setWorkplaceNumber(elementNumber){
    workplace_number = elementNumber;
}

function setRouting(workplace_number){
    if (!time_set[workplace_number] || markers[workplace_number] === null){
        // either time or place is unset
        // console.log('failed at 1 ', 'time set?: ',time_set[workplace_number], ' marker set?: ', markers[workplace_number], ' workplace number: ', workplace_number);
        return;
    } else if (markers[5] === null){
        // home is not set
        // console.log('failed at 2');
        return;
    } else {
        // both time and place are set do the routing
        var origin_latlng = markers[5].getPosition();
        var destination_latlng = markers[workplace_number].getPosition();
        var input_time = document.getElementById('input_time'.concat(workplace_number)).value;
        var transport_mode = document.getElementById('transport_mode_dropdown'.concat(workplace_number)).value;

        // get time for Route request
        let input_time_hour = input_time.substring(0, 2);
        let input_time_minutes = input_time.substring(3, 5);
        var current_time = new Date();
        var arrival_time = new Date(
            current_time.getFullYear(), 
            current_time.getMonth(),
            current_time.getDate(),
            parseInt(input_time_hour),
            parseInt(input_time_minutes)
        );
        arrival_time = new Date(arrival_time.valueOf() + ((8 - current_time.getDay()) * 86400000)); // change day to the followimg monday
        var departure_time_driving = new Date(arrival_time - 3600000);
        
        var route_api_request = {
            origin: origin_latlng.lat().toString().concat(',', origin_latlng.lng()),
            destination: destination_latlng.lat().toString().concat(',', destination_latlng.lng()),
            travelMode: transport_mode.toUpperCase()
        };

        switch (transport_mode){
            case 'driving':
                route_api_request.drivingOptions = {
                    departureTime: departure_time_driving,
                    trafficModel: 'pessimistic'
                }
                break;
            case 'transit':
                route_api_request.transitOptions = {
                    arrivalTime: arrival_time
                };
                // remove previous transitline markers
                for (let i = 0; i < workplace_element_added_number; i++){
                    if (i == workplace_number) continue; 

                    if (directionsRenderers[i].getDirections().request.travelMode == 'TRANSIT'){
                        var transit_steps_length = directionsRenderers[i].getDirections().routes[0].legs[0].steps.length;
                        for (let j = 0; j < transit_steps_length - 1; j++){
                            try {
                                directionsRenderers[i].getDirections().routes[0].legs[0].steps[j].transit = null;
                            } catch (err) {
                                // no transitline in this step
                            }
                        }
                        directionsRenderers[i].setMap(map);
                    }
                }
                break;
        }

        directionsService.route(route_api_request, function(response, status) {
                if (status === 'OK') {
                    // check if route is already set
                    if (typeof directionsRenderers[workplace_number] != 'undefined') {
                        // already existing route that needs to be removed
                        directionsRenderers[workplace_number].setMap(null);
                        delete directionsRenderers[workplace_number];
                    }
                    // add in new response
                    directionsRenderers[workplace_number] = new google.maps.DirectionsRenderer({
                        suppressMarkers: true,
                        preserveViewport: true,
                        suppressBicyclingLayer: true,
                        polylineOptions: {
                          strokeColor: colours[workplace_number],
                          strokeOpacity: 0.8,
                        }
                    });
                    directionsRenderers[workplace_number].setDirections(response);
                    directionsRenderers[workplace_number].setMap(map);
                    
                    // set times from response
                    var duration;
                    var departure_time;
                    var route_leg = directionsRenderers[workplace_number].getDirections().routes[0].legs[0];
                    switch (transport_mode){
                        case 'driving':
                            duration = route_leg.duration_in_traffic.text;
                            departure_time = new Date(arrival_time - (route_leg.duration_in_traffic.value * 1000));
                            departure_time = dateToDepartureTime(departure_time);
                            break;
                        case 'transit':
                            duration = route_leg.duration.text;
                            try {
                                departure_time = dateToDepartureTime(new Date(route_leg.departure_time.value));
                            } catch (err) {
                                // for when there is only walking since response will not contain departure time
                                duration = route_leg.duration.text;
                                departure_time = new Date(arrival_time - (route_leg.duration.value * 1000));
                                departure_time = dateToDepartureTime(departure_time);
                            }
                            break;
                        default:
                            duration = route_leg.duration.text;
                            departure_time = new Date(arrival_time - (route_leg.duration.value * 1000));
                            departure_time = dateToDepartureTime(departure_time);
                    }
                    document.getElementById('commute_time'.concat(workplace_number)).innerHTML = duration;
                    document.getElementById('departure_time'.concat(workplace_number)).innerHTML = departure_time;
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            }
        );
    }
}

function dateToDepartureTime(date){
    var hours;
    var minutes;
    var meridian;

    if (date.getHours() > 12) {
       hours = date.getHours() - 12;
       meridian = ' pm' 
    } else {
        hours = date.getHours();
        meridian = ' am';
    }
    minutes = ('0' + date.getMinutes()).slice(-2);
    return hours.toString().concat(':', minutes.toString(), meridian);
}