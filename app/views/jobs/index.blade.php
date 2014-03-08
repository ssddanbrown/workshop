@extends('common.main')

@section('content')
<div class="row-12">
	
	<h1 class="left">All Jobs</h1>

	<div class="row subheader">
		<h3>Outstanding Jobs</h3>
		{{ link_to_route('jobs.create', 'New Job', '', array('class'=>'button right') ) }}
	</div>

	@if ( count($jobs) >= 1 )
		@include('jobs.parts.jobtable')
	@else
		<p>No jobs to display....</p>
	@endif

	<div class="row">
		{{ link_to_route('jobs.archive', 'View Jobs Archive') }}
	</div>

</div>
@stop