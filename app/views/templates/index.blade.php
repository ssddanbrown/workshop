@extends('common.main')

@section('content')
	
	<div class="header">
		<h1>Templates</h1>
		<div class="buttons">
			{{ link_to_route('templates.create', 'New Template', null, array('class'=>'button right pos') ) }}
		</div>
	</div>

	<section>
		@if ( count($templates) > 0 )
			@foreach($templates as $template)
				<div class="third">
					<h2>{{ link_to_route('templates.show', $template->title, $template->id) }}</h2>
					<p>{{ $template->text }}</p>
					{{ link_to_route('jobs.createfromtemplate', 'New Job', $template->id, array('class' => 'button pos') ) }}
					{{ link_to_route('templates.edit', 'Edit', $template->id, array('class' => 'button') ) }}
					{{ Form::delete('templates.destroy', 'Delete', $template->id) }}
				</div>
			@endforeach
		@else
			<div><p>No templates to display....</p></div>
		@endif
	</section>

@stop