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
	<div class="half details">
		<div class="subheader">
			<h3>Details</h3>
		</div>
		<div>
			<div class="half">
				<div class="detail">
					<div>TITLE</div>
					<p>{{ $job->title }}</p>
				</div>
				<div class="detail">
					<div>DETAILS</div>
					<p>{{ $job->text }}</p>
				</div>
			</div>
			<div class="half">
				<div class="detail">
					<div>DATE DUE</div>
					<p>{{ Format::humanTime($job->due) }} - {{ Format::date($job->due) }}</p>
				</div>
				<div class="detail">
					<div>DATE ADDED</div>
					<p>{{ Format::humanTime($job->created_at) }} - {{ Format::date($job->created_at) }}</p>
				</div>
			</div>
		</div>
	</div>

	<div class="half">
		<div class="half details">
			<div class="subheader">
				<h3>Customer</h3>
			</div>
			<div>
				@if($job->customer != null)
					<div class="detail">
						<div>NAME</div>
						<p>{{ link_to_route('customers.show', $job->customer->name(), $job->customer->id) }}</p>
					</div>
					<div class="detail">
						<div>EMAIL</div>
						<p>{{ $job->customer->email }}</p>
					</div>
					<div class="detail">
						<div>PHONE</div>
						<p>{{ $job->customer->phone }}</p>
					</div>
				@else
					<p>No Customer Selected</p>
				@endif
			</div>
		</div>

		<!-- List All Customer Items -->
		<div class="half details">
			<div class="subheader">
				<h3>Items</h3>
			</div>
			<div>
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
	</div>
</section>

<!-- List All Costs -->
<section class="details">
	<div class="subheader">
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
	<div class="half details">
		<div class="subheader">
			<h3>Notes</h3>
		</div>
		{{ Form::open( array('route' => 'notes.store', 'files' => true) ) }}
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

	<div class="half details">
		<div class="subheader">
			<h3>Assigned Users</h3>
		</div>
		<div class="detail">
			<label for="user-search">Search for user to assign</label>
			<p>
				<input type="text" id="user-search" name="user-search">
			</p>
		</div>
	</div>	

</section>
<script>
$(document).ready(function(){

	// Auto Complete
	$('#user-search').autocomplete({
		source: '/users/search',
		select: function( event, ui ) {
			// On select option
			// recieved json is ui.item.{array item}
		}
	}).autocomplete("instance")._renderItem = function( ul, item ) {
		return $("<li>")
		.append("<a>" + item.username + "</a>")
		.appendTo( ul );
	};

});
</script>

@stop