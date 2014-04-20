@extends('common.main')

@section('content')

	{{ Form::model( $template, array( 'method' => 'PUT', 'route' => array('templates.update', $template->id ) ) ) }}

		<div class="header">
			<h1>Edit Template</h1>
			<div class="buttons">
				{{ Form::submit('Save Template', array('class'=>'button')) }}
			</div>
		</div>

		@include('templates.parts.templateform')

	{{ Form::close() }}

	@include('jobs.parts.addformjs')

@stop