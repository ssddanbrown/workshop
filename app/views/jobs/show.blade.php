@extends('common.main')

@section('content')
<div class="row-12">

	<h1>Job View</h1>
	<p><strong>Title: </strong>{{ $job->title }}</p>
	<p><strong>Job Notes: </strong>{{ $job->text }}</p>
	<p><strong>ID: </strong>{{ $job->id }}</p>
	<p><strong>Date Added: </strong>{{ $job->created_at }}</p>
	<p><strong>Date Due: </strong>{{ $job->due }}</p>
	<p><strong>Last Updated: </strong>{{ $job->updated_at }}</p>
	<p><strong>Customer Id: </strong>{{ $job->customer }}</p>
	<p><strong>Is Finished: </strong>{{ $job->finished }}</p>

	@if(count($job->items) > 0)
		<h2>Items</h2>
		@foreach($job->items as $item)
				<p><strong>{{ $item->item_title }}</strong><br>
				{{ $item->item_text }}</p>
		@endforeach
		<div class="row"></div>
	@else
		<p>No Items to display.</p>
	@endif

	@if(count($job->costs) > 0)
		<h2>Costs</h2>
		@foreach($job->costs as $cost)
			<p><strong>{{ $cost->cost_qty }}</strong>
				{{ $cost->cost_text }} at £{{ sprintf('%0.2f', $cost->cost_price) }} each.
			</p>
		@endforeach
	@else
		<p>No Costs to display.</p>
	@endif

</div>
@stop