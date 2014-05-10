<!doctype html>
<html lang="en">
<head>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,400italic,500,700' rel='stylesheet' type='text/css'>
	<meta charset="UTF-8">
	<title>Workshop</title>
	{{ HTML::style('css/style.css') }}
	{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js') }}
	@yield('head')
</head>
<body>
	
	<!-- Header -->
	<div class="row" id="header">
			{{ link_to_route('jobs.index', 'All Jobs', null, array('class'=>'link')) }}
			{{ link_to_route('customers.index', 'All Customers', null, array('class'=>'link')) }}
			{{ link_to_route('templates.index', 'All Templates', null, array('class'=>'link')) }}
	</div>

	<!-- Content -->
	<div class="row">
		@yield('content')
	</div>

</body>
</html>