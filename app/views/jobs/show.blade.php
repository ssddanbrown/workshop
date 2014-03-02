@extends('common.main')

@section('content')
<div class="row">
	
	<div class="row"><h1>Job View</h1></div>
	<div class="row-6">
		<h2>Job Details</h2>
		<p><strong>Title: </strong>{{ $job->title }}</p>
		<p><strong>Job Notes: </strong>{{ $job->text }}</p>
		<p><strong>ID: </strong>{{ $job->id }}</p>
		<p><strong>Date Added: </strong>{{ $job->created_at }}</p>
		<p><strong>Date Due: </strong>{{ $job->due }}</p>
		<p><strong>Last Updated: </strong>{{ $job->updated_at }}</p>
		<p><strong>Is Finished: </strong>{{ $job->finished }}</p>
	</div>
	<div class="row-6">
		<h2>Customer Details</h2>
		@if($job->customer != null)
			<p><strong>Name: </strong>{{ $job->customer->name }}</p>
			<p><strong>Email: </strong>{{ $job->customer->email }}</p>
			<p><strong>Phone: </strong>{{ $job->customer->phone }}</p>
		@else
			<p>No Customer Added</p>
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