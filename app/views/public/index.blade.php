@extends('common.public')

@section('content')

	<h1>Available Services</h1>
	
	<section>

		@if(count($templates) > 0)
			@foreach($templates as $template)
				<div class="third">
					<h4>{{ $template->title }}</h4>
					<p>{{ $template->text }}</p>
					<p><strong>Approximate Price: {{ Format::price($template->total) }}</strong></p>
					<p>{{ link_to_route('booking.create', 'Book This Job', $template->id, array('class'=>'button')) }}</p>
				</div>
			@endforeach
		@else
			<p>There are no jobs available at the moment</p>
		@endif

	</section>
	
@stop