@extends('common.main')

@section('content')
<div class="row-12">
	<h1>All Jobs</h1>

	@if ( count($jobs) >= 1 )
		<table class="table-grid" >
			<thead>
				<tr>
					<th>ID</th>
					<th>Job</th>
					<th>Customer</th>
					<th>Due date</th>
					<th>Date Added</th>
				</tr>
			</thead>
			<tbody>
				@foreach ( $jobs as $job )
					<tr>
						<td>{{ $job->id }}</td>
						<td>{{ link_to_route('jobs.show', $job->title, $job->id) }}</td>
						@if( $job->customer != null )
							<td>{{ $job->customer->name }}</td>
						@else
							<td>No Customer</td>
						@endif
						<td>{{ date_create($job->due)->format('jS F, g:i a') }}</td>
						<td>{{ date_create($job->created_at)->format('jS F, g:i a') }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<p>No jobs to display....</p>
	@endif
	<p></p>
	<p>{{ link_to("/jobs/create", 'Add New Job') }}</p>

</div>
@stop