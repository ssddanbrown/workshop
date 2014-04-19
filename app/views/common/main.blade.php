<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Workshop</title>
	{{ HTML::style('css/style.css') }}
	{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js') }}
</head>
<body>
	
	<!-- Header -->
	<div class="row" id="header">
		<div class="row-12">
			{{ link_to_route('jobs.index', 'All Jobs', null, array('class'=>'link')) }}
			{{ link_to_route('customers.index', 'All Customers', null, array('class'=>'link')) }}
			{{ link_to_route('templates.index', 'All Templates', null, array('class'=>'link')) }}
		</div>
	</div>

	<!-- Content -->
	<div class="row">
		@yield('content')
	</div>

</body>
</html>