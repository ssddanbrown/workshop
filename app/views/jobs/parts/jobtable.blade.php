<table class="table-grid" >
	<thead>
		<tr>
			<th><a href="?sort=id&amp;order={{$order}}">ID</a></th>
			<th><a href="?sort=title&amp;order={{$order}}">Job</a></th>
			<th><a href="?sort=customer_id&amp;order={{$order}}">Customer</a></th>
			<th><a href="?sort=due&amp;order={{$order}}">Due date</a></th>
			<th><a href="?sort=created_at&amp;order={{$order}}">Date Added</a></th>
			<th><a href="?sort=state_id&amp;order={{$order}}">Status</a></th>
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