@extends('common.main')

@section('content')
	
	<div class="header">
		<h1>Outstanding Jobs</h1>
		<div class="buttons">
			{{ link_to_route('jobs.create', 'New Job', null, array('class'=>'button right pos') ) }}
		</div>
	</div>
	
	<div>
		@if ( count($jobs) > 0 )
			@include('jobs.parts.jobtable')
		@else
			<p>No jobs to display....</p>
		@endif
	</div>

	<div>
		{{ link_to_route('jobs.archive', 'Jobs Archive', null, array('class'=>'link') ) }}
	</div>

@stop