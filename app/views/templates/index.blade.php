@extends('common.main')

@section('content')
	
	<div class="row-12 header">
		<h1>Templates</h1>
		<div class="buttons">
			{{ link_to_route('templates.create', 'New Template', null, array('class'=>'button right pos') ) }}
		</div>
	</div>
	
	@if ( count($templates) > 0 )
		@foreach($templates as $template)
			<div class="row-4">
				<h2>{{ $template->title }}</h2>
				<p>{{ $template->text }}</p>
				{{ link_to_route('jobs.createfromtemplate', 'New Job', $template->id, array('class' => 'button pos') ) }}
				{{ link_to_route('templates.edit', 'Edit', $template->id, array('class' => 'button') ) }}
				{{ Form::delete('templates.destroy', 'Delete', $template->id) }}
			</div>
		@endforeach
	@else
		<div class="row-12"><p>No templates to display....</p></div>
	@endif

@stop