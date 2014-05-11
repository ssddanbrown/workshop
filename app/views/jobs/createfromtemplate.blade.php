@extends('common.main')

@section('content')

	{{ Form::model($job, array('route' => 'jobs.store')) }}

		<div class="row-12 header">
			<h1>New {{ $template->title }}</h1>
			<div class="buttons">
				{{ Form::submit('Save Job', array('class'=>'button pos') ) }}
			</div>
		</div>

		@include('jobs.parts.jobform')

	{{ Form::close() }}

	@include('jobs.parts.addformjs')

@stop