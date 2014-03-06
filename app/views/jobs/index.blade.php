@extends('common.main')

@section('content')
<div class="row-12">
	
	<div class="row">
		<h1 class="left">All Jobs</h1>
		
	</div>

	<div class="row subheader">
		<h3 class="left">Outstanding Jobs</h3>
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
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<p>No jobs to display....</p>
	@endif

</div>
@stop