@extends('common.main')

@section('content')
<div class="row">
	
	<div class="row-12 header">
		<h1>Job Information</h1>
		<div class="buttons">
			{{ Form::toggleFinished($job) }}
			{{ link_to_route( 'jobs.edit', 'Edit Job', $job->id, array('class'=>'button') ) }}
			{{ Form::delete('jobs.destroy', 'Delete Job', $job->id) }}
		</div>
	</div>

	<div class="row-6">
		<div class="row subheader">
			<h3>Details</h3>
		</div>
		<div class="row-6 fill">
			<div class="detail">
				<div>TITLE</div>
				<p>{{ $job->title }}</p>
			</div>
			<div class="detail">
				<div>NOTES</div>
				<p>{{ $job->text }}</p>
			</div>
			<div class="detail">
				<div>ID</div>
				<p>{{ $job->id }}</p>
			</div>
			<div class="detail">
				<div>STATUS</div>
				<p>{{ $job->finished }}</p>
			</div>
		</div>

		<div class="row-6 fill">
			<div class="detail">
				<div>DATE ADDED</div>
				<p>{{ $job->created_at }}</p>
			</div>
			<div class="detail">
				<div>DATE DUE</div>
				<p>{{ $job->due }}</p>
			</div>
			<div class="detail">
				<div>LAST UPDATED</div>
				<p>{{ $job->updated_at }}</p>
			</div>
		</div>
	</div>

	<div class="row-3">
		<div class="row subheader">
			<h3>Customer</h3>
		</div>
		@if($job->customer != null)
			<div class="detail">
				<div>NAME</div>
				<p>{{ $job->customer->name() }}</p>
			</div>
			<div class="detail">
				<div>EMAIL</div>
				<p>{{ $job->customer->email }}</p>
			</div>
			<div class="detail">
				<div>PHONE</div>
				<p>{{ $job->customer->phone }}</p>
			</div>
			<div class="detail">
				<p>{{ link_to_route('customers.show', 'View customer record', $job->customer->id, array('class'=>'link') ) }}</p>
			</div>
		@else
			<p>No customer added.</p>
		@endif
	</div>

	<!-- List All Customer Items -->
	<div class="row-3">
		<div class="row subheader">
			<h3>Items</h3>
		</div>
		@if(count($job->items) > 0)
			@foreach($job->items as $item)
				<div class="detail">
					<div>{{ $item->item_title }}</div>
					<p>{{ $item->item_text }}</p>
				</div>
			@endforeach
			<div class="row"></div>
		@else
			<p>No Items to display.</p>
		@endif
	</div>

	<div class="row"></div>

	<!-- List All Costs -->
	<div class="row-12">
		<div class="row subheader">
			<h3>Costs</h3>
		</div>
		@if(count($job->costs) > 0)
			<table class="table-grid">
				<thead>
					<th>Quantity</th>
					<th>Description</th>
					<th>Price</th>
					<th>Total</th>
				</thead>
			@foreach($job->costs as $cost)
				<tr>
					<td>{{ $cost->cost_qty }}</td>
					<td>{{ $cost->cost_text }}</td>
					<td>{{ Format::price($cost->cost_price) }}</td>
					<td>{{ Format::price($cost->total()) }}</td>
				</tr>
			@endforeach
				<tr>
					<td></td>
					<td></td>
					<td>Job Total:</td>
					<td>{{ Format::price($job->total) }}</td>
				</tr>
			</table>
		@else
			<p>No Costs to display.</p>
		@endif
	</div>

	<div class="row-8">
		<div class="row subheader">
			<h3>Notes</h3>
		</div>
		@if( count($job->notes) > 0 )
			@foreach( $job->notes as $note )
				<div class="note">
					<div class="row-9 fill detail">
						<div>{{ $note->created_at }}</div>
						<p>{{ $note->text }}</p>
					</div>
					<div class="row-3 fill">
						{{ Form::delete('notes.destroy', 'Delete', $note->id) }}
						{{ link_to_route('notes.edit', 'Edit', $note->id, array('class'=>'button') ) }}
					</div>
					<div class="row"></div>
				</div>
			@endforeach
		@else
			<p>No notes added</p>
		@endif
	</div>
	<div class="row-4">
		{{ Form::open( array('route' => 'notes.store') ) }}
		<div class="row subheader">
			<h3>Add Note</h3>
		</div>
		{{ Form::hidden('job_id', $job->id) }}
		<div class="detail">
			{{ Form::label('text', 'Note Text') }}
			{{ Form::textarea('text') }}
			{{ Form::submit('Save Note', array('class'=>'button right') ) }}
		</div>
		{{ Form::close() }}
	</div>

</div>
@stop