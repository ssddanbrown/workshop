<table class="table-grid" >
	<thead>
		<tr>
			<th><a href="?order=id">ID</a></th>
			<th><a href="?order=title">Job</a></th>
			<th><a href="?order=customer_id">Customer</a></th>
			<th><a href="?order=due">Due date</a></th>
			<th><a href="?order=created_at">Date Added</a></th>
			<th><a href="?order=state_id">Status</a></th>
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
					<td>None</td>
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