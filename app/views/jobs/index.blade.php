@extends('common.main')

@section('content')
<div class="row-12">
	
	<h1 class="left">All Jobs</h1>

	<div class="row subheader">
		<h3>Outstanding Jobs</h3>
		{{ link_to("/jobs/create", 'New Job', array('class'=>'button right') ) }}
	</div>

	@if ( count($jobs) >= 1 )
		<table class="table-grid" >
			<thead>
				<tr>
					<th>ID</th>
					<th>Job</th>
					<th>Customer</th>
					<th>Due date</th>
					<th>Date Added</th>
					<th>Actions</th>
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
						<td>{{ $job->humanTime('due'); }}</td>
						<td>{{ $job->humanTime('created_at'); }}</td>
						@if($job->finished)
							<td>{{ link_to_route('jobs.toggle', 'Not Done', $job->id,
							array('class'=>'button') ) }}</td>
						@else
							<td>{{ link_to_route('jobs.toggle', 'Done', $job->id,
							array('class'=>'button') ) }}</td>
						@endif
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<p>No jobs to display....</p>
	@endif

</div>
@stop