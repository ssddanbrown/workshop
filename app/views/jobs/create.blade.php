@extends('common.main')

@section('content')
<div class="row-12">

	<h1>Add New Job</h1>
	{{ Form::open(array('route' => 'jobs.store')) }}

		@include('jobs.parts.jobform')
		
		<div>{{ Form::submit('Add Job') }}</div>

	{{ Form::close() }}

	@include('jobs.parts.addformjs')

</div>
@stop