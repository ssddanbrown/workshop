<!doctype html>
<html lang="en">
<head>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,400italic,500,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lily+Script+One' rel='stylesheet' type='text/css'>
	<meta charset="UTF-8">
	<title>Workshop</title>
	{{ HTML::style('css/style.css') }}
	{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js') }}
	@yield('head')
</head>
<body>
	
	<div class="row" id="site-header">
		<div class="logo">Workshop</div>
		<ul class="inline">
			<li>{{ link_to_route('jobs.index', 'Jobs') }}</li>
			<li>{{ link_to_route('customers.index', 'Customers') }}</li>
			<li>{{ link_to_route('templates.index', 'Templates') }}</li>
		</ul>
	</div>

	<div class="row">
		@yield('content')
	</div>

</body>
</html>