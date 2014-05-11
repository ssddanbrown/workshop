@extends('common.main')

@section('content')

	{{ Form::model( $note, array('method'=>'put', 'route' => array('notes.update', $note->id) ) ) }}

		<div class="header">
			<h1>Edit Note</h1>
			<div class="buttons">
				{{ Form::submit('Save', array('class'=>'button pos') ) }}
			</div>
		</div>
		<div>
			{{ Form::textarea('text') }}
		</div>

	{{ Form::close() }}

@stop