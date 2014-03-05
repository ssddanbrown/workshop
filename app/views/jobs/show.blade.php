@extends('common.main')

@section('content')
<div class="row">
	
	<div class="row-12">
		<h1>Job View</h1>
	</div>

	<div class="row-12">
		<div class="row-2">
			{{ Form::open(array( 'method' => 'GET', 'route' => array('jobs.edit', $job->id) )) }}
				{{ Form::submit('Edit Job') }}
			{{ Form::close() }}
		</div>
		<div class="row-2">
			{{ Form::open(array( 'method' => 'DELETE', 'route' => array('jobs.destroy', $job->id) )) }}
				{{ Form::submit('Delete Job') }}
			{{ Form::close() }}
		</div>
	</div>

	<div class="row-6">
		<h2>Details</h2>
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
		<div class="detail">
			<div>STATUS</div>
			<p>{{ $job->finished }}</p>
		</div>
	</div>

	<div class="row-6">
		<h2>Customer</h2>
		@if($job->customer != null)
			<div class="detail">
				<div>NAME</div>
				<p>{{ $job->customer->name }}</p>
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
				<p>{{ link_to_route('customers.show', 'View customer record', $job->customer->id) }}</p>
			</div>
		@else
			<p>No customer added.</p>
		@endif
	</div>

	<div class="row"></div>

	<!-- List All Customer Items -->
	<div class="row-6">
		<h2>Items</h2>
		@if(count($job->items) > 0)
			@foreach($job->items as $item)
					<p><strong>{{ $item->item_title }}</strong><br>
					{{ $item->item_text }}</p>
			@endforeach
			<div class="row"></div>
		@else
			<p>No Items to display.</p>
		@endif
	</div>

	<!-- List All Costs -->
	<div class="row-6">
		<h2>Costs</h2>
		@if(count($job->costs) > 0)
			@foreach($job->costs as $cost)
				<p><strong>{{ $cost->cost_qty }}</strong>
					{{ $cost->cost_text }} at £{{ sprintf('%0.2f', $cost->cost_price) }} each.
				</p>
			@endforeach
		@else
			<p>No Costs to display.</p>
		@endif
	</div>

</div>
@stop