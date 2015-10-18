<!DOCTYPE html>
<head>
	<title>DNS - Propagation</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DNS Checker</title>
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

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
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//code.jquery.com/jquery-2.1.3.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="/js/validation.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="http://bootboxjs.com/bootbox.js"></script>
	<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
</body>
</html>
