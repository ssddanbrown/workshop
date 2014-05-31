@extends('common.main')

@section('content')
	
<div class="header">
	<h1>Job Information</h1>
	<div class="buttons">
		{{ link_to_route( 'jobs.edit', 'Edit Job', $job->id, array('class'=>'button') ) }}
		{{ Form::delete('jobs.destroy', 'Delete Job', $job->id) }}
	</div>
</div>

<section class="states">
	{{ $job->displayStates() }}
</section>

<section>
	<div class="half">
		<div class="row subheader">
			<h3>Details</h3>
		</div>
		<div>
			<div class="half">
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
					<div>STATE - ID</div>
					<p>{{ $job->state->name }} - {{ $job->state->id }}</p>
				</div>
			</div>
			<div class="half">
				<div class="detail">
					<div>DATE ADDED</div>
					<p>{{ Format::date($job->created_at) }}<br>{{ Format::humanTime($job->created_at) }}</p>
				</div>
				<div class="detail">
					<div>DATE DUE</div>
					<p>{{ Format::date($job->due) }}<br>{{ Format::humanTime($job->due) }}</p>
				</div>
				<div class="detail">
					<div>LAST UPDATED</div>
					<p>{{ Format::date($job->updated_at) }}<br>{{ Format::humanTime($job->updated_at) }}</p>
				</div>
			</div>
		</div>
	</div>

	<div class="half">
		<div class="half">
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
				<p>No Customer Selected</p>
			@endif
		</div>

		<!-- List All Customer Items -->
		<div class="half">
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
			@else
				<p>No Items To Display.</p>
			@endif
		</div>
	</div>
</section>

<!-- List All Costs -->
<section>
	<div class="row subheader">
		<h3>Costs</h3>
	</div>
	@if(count($job->costs) > 0)
		<table class="table-grid">
			<thead>
				<th>Quantity</th>
				<th>Description</th>
				<th>Price</th>
				<th>Discount</th>
				<th>Total</th>
			</thead>
		@foreach($job->costs as $cost)
			<tr>
				<td>{{ $cost->cost_qty }}</td>
				<td>{{ $cost->cost_text }}</td>
				<td>{{ Format::price($cost->cost_price) }}</td>
				<td>{{ $cost->discount }}%</td>
				<td>{{ $cost->total(true) }}</td>
			</tr>
		@endforeach
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td><strong>Job Total:</strong></td>
				<td>{{ Format::price($job->total) }}</td>
			</tr>
		</table>
	@else
		<p>No Costs to display.</p>
	@endif
</section>

<section>
	<div class="half">
		<div class="row subheader">
			<h3>Notes</h3>
		</div>
		@if( count($job->notes) > 0 )
			@foreach( $job->notes as $note )
				<div class="note clear">
					<div class="detail">
						<div>{{ Format::humanTime($note->created_at) . ' - ' . Format::date($note->created_at) }}</div>
						<p>{{ $note->text }}</p>
						@if( $note->media != null)
						<p><a class="link" href="{{ $note->media }}">{{ $note->media_name }}</a></p>
						@endif
					</div>
					<div class="buttons">
						{{ link_to_route('notes.edit', 'Edit', $note->id, array('class'=>'button') ) }}
						{{ Form::delete('notes.destroy', 'Delete', $note->id) }}
					</div>
				</div>
			@endforeach
		@else
			<p>No notes added</p>
		@endif
	</div>
	<div class="half">
		{{ Form::open( array('route' => 'notes.store', 'files' => true) ) }}
		<div class="row subheader">
			<h3>Add Note</h3>
		</div>
		{{ Form::hidden('job_id', $job->id) }}
		<div class="detail">
			{{ Form::label('text', 'Note Text') }}
			{{ Form::textarea('text') }}
			<div class="clear"></div>
		</div>
		<div class="detail">
			{{ Form::label('media', 'Attach File') }}
			{{ Form::file('media', [ 'files'=>true ]) }}
		</div>
		{{ Form::submit('Save Note', array('class'=>'button pos') ) }}
		{{ Form::close() }}
	</div>	
</section>


@stop