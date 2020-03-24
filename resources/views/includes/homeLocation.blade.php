<h2 class="ml-2 mr-2 mb-3">home</h2>
<div class="row no-gutters border rounded flex-md-row m-2 shadow-sm position-relative">
    <div class="container-fluid mt-4 mb-4 mr-2">
        <div class="row">
            <div class="col-6">
            	<div class="form-group mt-4">
           		    <input type="text" id="address-input" name="address_address" class="form-control map-input" placeholder="Enter home location">
		            <input type="hidden" name="address_latitude" id="address-latitude" value="0" />
                    <input type="hidden" name="address_longitude" id="address-longitude" value="0" />
                </div>
            </div>
            <div class="col-2 mt-3 pr-0">
                <div class="container-fluid p-0">
                    <div class="row m-1">
                        Address Line 1:
                    </div>
                    <div class="row m-1">
                        Address Line 2:
                    </div>
                    <div class="row m-1">
                        Address Line 3:
                    </div>
                    <div class="row m-1">
                        Postcode:
                    </div>
                </div>
            </div>
            <div class="col-4 mt-3 pl-0">
                <div class="container-fluid">
                    <div class="row m-1">
                        38 Acorn Walk
                    </div>
                    <div class="row m-1">
                        Beech Court
                    </div>
                    <div class="row m-1">
                        London
                    </div>
                    <div class="row m-1">
                        SE165DU
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>

{{-- google api scripts --}}
@section('scripts')
    @parent
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
    <script src="js/mapInput.js"></script>
@stop