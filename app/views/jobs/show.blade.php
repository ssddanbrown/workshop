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
	<p><strong>Items: </strong></p>
	@foreach($job->items as $item)
	<p>{{ $item->detail }}<br> {{ $item->text }}</p>
	@endforeach
	<p><strong>Costs: </strong> </p>
	@foreach($job->costs as $cost)
	<p>{{ $cost->qty }}x {{ $cost->text}} @ £{{ $cost->price }} each</p>
	@endforeach

</div>
@stop