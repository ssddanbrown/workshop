@extends('common.main')

@section('content')

	{{ Form::open(array('route' => 'jobs.store')) }}

		<div class="row-12 header">
			<h1>New Job</h1>
			<div class="buttons">
				{{ Form::submit('Add Job', array('class'=>'button') ) }}
			</div>
		</div>

		@include('jobs.parts.jobform')

	{{ Form::close() }}

	@include('jobs.parts.addformjs')

@stop