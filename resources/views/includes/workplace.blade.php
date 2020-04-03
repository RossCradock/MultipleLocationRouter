<link rel="stylesheet" type="text/css" media="screen" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

<script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

<h2>workplace</h2>
<div class="no-gutters border rounded shadow-sm h-75">
	<div class="p-4">
		{{-- https://stackoverflow.com/questions/3059044/google-maps-js-api-v3-simple-multiple-marker-example --}}
		<div class="form-group mt-3">
			<input type="text" placeholder="Enter workplace location" id="pac-input-workplace" class="form-control map-input">
		</div>

		{{-- https://hdtuto.com/article/laravel-timepicker-example-using-bootstrap-datetimepicker-plugin 
			 http://eonasdan.github.io/bootstrap-datetimepicker/#time-only --}}
		<p class="card-text mb-auto" style="padding-left: 0.5%; padding-top: 2%">Enter arrival time at work destination below:</p>
        <div>
            <div style="position: relative; padding-top: 2%">
				<input class="timepicker form-control" placeholder="Enter arrival time (00:00)" type="text">
            </div>
        </div>
        <script type="text/javascript">
            $('.timepicker').datetimepicker({
				format: 'HH:mm'
            }); 
        </script> 
    </div>
</div>