@extends('common.main')

@section('content')

<h1>Job View</h1>
<p><strong>Title: </strong>{{ $job->title }}</p>
<p><strong>Job Notes: </strong>{{ $job->text }}</p>
<p><strong>ID: </strong>{{ $job->id }}</p>
<p><strong>Date Added: </strong>{{ $job->created_at }}</p>
<p><strong>Date Due: </strong>{{ $job->due }}</p>
<p><strong>Last Updated: </strong>{{ $job->updated_at }}</p>
<p><strong>Customer Id: </strong>{{ $job->customer }}</p>
<p><strong>Is Finished: </strong>{{ $job->finished }}</p>
<p><strong>Items: </strong>{{ $job->items }}</p>
<p><strong>Costs: </strong>{{ $job->costs }}</p>

@stop