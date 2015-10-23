<!DOCTYPE html>
<head>
	<title>DNS - Propagation</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DNS Checker</title>
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/jquery-jvectormap-2.0.4.css') }}" rel="stylesheet">

		<!-- Datepicker -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

</head>
<body>
	<div class="container-fluid"><br>
	  <div class="row">
	    <div class="col-md-5 col-md-offset-0.5">
        	<div class="panel-body">
							@yield('content')
					</div>
	    </div>
			<div class="col-md-5 col-md-offset-0.5">
	      <h1>Aqui va el mapa</h1>
				<div class="panel-body ">
							@yield('map')
				</div>
	    </div>
		</div>
	</div>

	<!-- Scripts -->
	{!! Html::script('/js/jquery/jquery-2.1.4.min.js') !!}
	{!! Html::script('/js/jquery/jquery-ui.js') !!}
	{!! Html::script('/js/jquery-jvectormap-2.0.4.min.js') !!}
	{!! Html::script('/js/jquery-jvectormap-world-mill-en.js') !!}
	{!! Html::script('/js/jquery-jvectormap-ve-mill.js') !!}
	{!! Html::script('/js/validation.js') !!}
	{!! Html::script('/js/bootstrap/bootstrap.min.js') !!}
	{!! Html::script('/js/bootbox/bootbox.min.js') !!}
	<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
</body>
</html>
