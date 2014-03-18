@extends('common.main')

@section('content')
	
	<div class="row-12 header">
		<h1>Outstanding Jobs</h1>
		<div class="buttons">
			{{ link_to_route('jobs.create', 'New Job', null, array('class'=>'button right') ) }}
		</div>
	</div>
	
	<div class="row-12">
		@if ( count($jobs) > 0 )
			@include('jobs.parts.jobtable')
		@else
			<p>No jobs to display....</p>
		@endif
	</div>

	<div class="row-12">
		{{ link_to_route('jobs.archive', 'Jobs Archive', null, array('class'=>'link') ) }}
	</div>

@stop