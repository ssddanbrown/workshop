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
				<td>{{ Form::toggleFinished($job) }}</td>
			</tr>
		@endforeach
	</tbody>
</table>