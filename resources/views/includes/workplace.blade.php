<link rel="stylesheet" type="text/css" media="screen" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

<script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

<div class="no-gutters border rounded shadow-sm" style="background-color: #FAFAFA;">
	<div id="workplace_color_top_border{{ $workplaceNo }}" style="height: 0.4em; background-color: #6A9491; border-top-left-radius: 2px; border-top-right-radius: 2px;"></div>
	<div class="p-4">
		<p class="card-text mb-auto text-muted" style="padding-left: 0.5%">Enter workplace below:</p>
		<div class="form-group">
			<input type="text" placeholder="Enter workplace location" id="pac_input_workplace{{ $workplaceNo }}" onfocus="setWorkplaceNumber({{ $workplaceNo }})" class="form-control map-input">
		</div>
		<p class="card-text mb-auto text-muted" style="padding-left: 0.5%">Enter arrival time at work below:</p>
        <div class="mb-2">
            <div>
				<input type="text" class="timepicker form-control" id="input_time{{ $workplaceNo }}" value="09:00" onfocus="setWorkplaceNumber({{ $workplaceNo }})" onfocusout="timeChanged(this.value)">
            </div>
        </div>
        <script type="text/javascript">
            $('.timepicker').datetimepicker({
				format: 'HH:mm'
			}); 
        </script> 
    </div>
</div>