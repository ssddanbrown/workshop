@extends('common.main')

@section('content')

	{{ Form::open(array('route' => 'templates.store')) }}

		<div class="header">
			<h1>New Template</h1>
			<div class="buttons">
				{{ Form::submit('Save Template', array('class'=>'button pos')) }}
			</div>
		</div>

		@include('templates.parts.templateform')

	{{ Form::close() }}

	@include('jobs.parts.addformjs')

@stop