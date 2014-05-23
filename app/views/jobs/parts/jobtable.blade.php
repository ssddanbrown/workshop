<table class="table-grid" >
	<thead>
		<tr>
			<th>ID</th>
			<th>Job</th>
			<th>Customer</th>
			<th>Due date</th>
			<th>Date Added</th>
			<th>Status</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach ( $jobs as $job )
			<tr>
				<td>{{ $job->id }}</td>
				<td>{{ link_to_route('jobs.show', $job->title, $job->id) }}</td>
				@if( $job->customer != null )
					<td>{{ $job->customer->name() }}</td>
				@else
					<td>No Customer</td>
				@endif
				<td>{{ Format::humanTime($job->due) }}</td>
				<td>{{ Format::humanTime($job->created_at) }}</td>
				<td>{{ $job->state->name }}</td>
				<td>
					{{ link_to_route('jobs.edit', 'Edit', $job->id, array('class'=>'button') ) }}
					{{ Form::delete('jobs.destroy', 'Delete', $job->id) }}
				</td>
			</tr>
		@endforeach
	</tbody>
</table>