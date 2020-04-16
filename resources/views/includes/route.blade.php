<div class="col p-4 flex-fill no-gutters border rounded justify-content-start shadow-sm" style="background-color: #FAFAFA;">
    <div class="container-fluid p-0">
        <div class="row ">
            <div class="col-12">
		        <p class="card-text mb-auto text-muted" style="padding-left: 0.5%">Enter transport mode below:</p>
		        <div class="form-group">
			        <select id="transport_mode_dropdown{{ $workplaceNo }}" class="form-control" onfocus="setWorkplaceNumber({{ $workplaceNo }})" onchange="transportModeChanged()">
				        <option value="driving">Driving (best estimate with traffic)</option>
				        <option value="walking">Walking</option>
				        <option value="bicycling">Cycling</option>
				        <option value="transit">Transit (arriving before set arrival time)</option>
			        </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <strong class="pl-4">Commute Time</strong>
            </div>
            <div class="col-7">
                <p id="commute_time{{ $workplaceNo }}">&NonBreakingSpace;</p>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                <strong class="pl-4">Departure Time</strong>
            </div>
            <div class="col-7">
                <p id="departure_time{{ $workplaceNo }}" class="mb-0">&NonBreakingSpace;</p>
            </div>
        </div>
    </div>
</div>