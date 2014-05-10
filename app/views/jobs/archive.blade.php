@extends('common.main')

@section('content')
	
	<div class="header row-12">
		<h1>Jobs Archive</h1>
		<div class="buttons">
			{{ link_to_route('jobs.create', 'New Job', '', array('class'=>'button right pos') ) }}
		</div>
	</div>

	@if ( count($jobs) >= 1 )
		@include('jobs.parts.jobtable')
	@else
		<p>No Finished Jobs</p>
	@endif

	<div>
		{{ link_to_route('jobs.index', 'View Outstanding Jobs', null, array('class'=>'link') ) }}
	</div>

@stop