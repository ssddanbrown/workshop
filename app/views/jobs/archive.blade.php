@extends('common.main')

@section('content')
<div class="row-12">
	
	<h1 class="left">Jobs Archive</h1>

	<div class="row subheader">
		<h3>Finished Jobs</h3>
		{{ link_to_route('jobs.create', 'New Job', '', array('class'=>'button right') ) }}
	</div>

	@if ( count($jobs) >= 1 )
		@include('jobs.parts.jobtable')
	@else
		<p>No Finished Jobs</p>
	@endif

	<div class="row">
		{{ link_to_route('jobs.index', 'View Outstanding Jobs') }}
	</div>

</div>
@stop