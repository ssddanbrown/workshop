@extends('common.main')

@section('content')
<div class="row-12">
	<h1>All Jobs</h1>
	@if ( count($jobs) >= 1 )
		@foreach ( $jobs as $job )
			<li>{{ link_to("/jobs/{$job->id}", $job->title ) }}</li>
		@endforeach
	@else
		<p>No jobs to display....</p>
	@endif

	<p>{{ link_to("/jobs/create", 'Add New Job') }}</p>

</div>
@stop