@extends('common.public')

@section('content')

	<h1>Available Jobs</h1>

	@foreach($templates as $template)
		<div class="third">
			<h4>{{ $template->title }}</h4>
			<p>{{ $template->text }}</p>
			<p><strong>{{ Format::price($template->total) }}</strong></p>
		</div>
	@endforeach

@stop