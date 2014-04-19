@extends('common.main')

@section('content')

	{{ Form::open(array('route' => 'templates.store')) }}

		<div class="row-12 header">
			<h1>New Template</h1>
			<div class="buttons">
				{{ Form::submit('Add Template', array('class'=>'button')) }}
			</div>
		</div>

		@include('templates.parts.templateform')

	{{ Form::close() }}

	@include('jobs.parts.addformjs')

@stop