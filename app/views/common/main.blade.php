<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Workshop</title>
	{{ HTML::style('css/style.css') }}
</head>
<body>
	<div class="row" id="header">
		<div class="row-12">
			{{ link_to_route('jobs.index', 'All Jobs') }}
			{{ link_to_route('customers.index', 'All Customers') }}
		</div>
	</div>
	<div class="row">
		@yield('content')
	</div>
</body>
</html>