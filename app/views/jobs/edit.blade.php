@extends('common.main')

@section('content')
<div class="row-12">

	<h1>Edit Job</h1>
	{{ Form::model( $job, array( 'method' => 'PUT', 'route' => array('jobs.update', $job->id) ) ) }}

		@include('jobs.parts.jobform')
		
		<div>{{ Form::submit('Save Job') }}</div>

	{{ Form::close() }}

	@include('jobs.parts.addformjs')

</div>
@stop