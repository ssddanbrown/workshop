<!doctype html>
<html lang="en">
<head>
	{{ HTML::style('http://fonts.googleapis.com/css?family=Roboto:400,300,400italic,500,700') }}
	{{ HTML::style('//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css') }}
	<meta charset="UTF-8">
	<title>Workshop</title>
	{{ HTML::style('css/style.css') }}
	{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js') }}
	{{ HTML::script('//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js') }}
	@yield('head')
</head>
<body>
	
	<div class="row" id="site-header">
		<a class="logo" href="{{ route('jobs.index') }}">{{ HTML::image('images/logo.png', 'Logo') }}</a>
		<ul class="inline">
			<li>{{ link_to_route('jobs.index', 'Jobs') }}</li>
			<li>{{ link_to_route('customers.index', 'Customers') }}</li>
			<li>{{ link_to_route('templates.index', 'Templates') }}</li>
			<li>{{ link_to_route('settings.index', 'Settings') }}</li>
			<li>{{ link_to_route('login.logout', 'Logout') }}</li>
		</ul>
	</div>

	<div class="row">
		@yield('content')
	</div>

</body>
</html>