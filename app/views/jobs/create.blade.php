@extends('common.main')

@section('content')

<h1>Add New Job</h1>

{{ Form::open(array('route' => 'jobs.store')) }}

	<div>
		{{ Form::label('title', 'Title:') }}
		{{ Form::text('title') }}
		{{ $errors->first('title') }}
	</div>
	<div>
		{{ Form::label('text', 'Job Notes:') }}
		{{ Form::text('text') }}
		{{ $errors->first('text') }}
	</div>
	<div>
		{{ Form::label('due', 'Date Due:') }}
		{{ Form::input('datetime', 'due', date("Y-m-d H:i:s")) }}
	</div>

	<div>{{ Form::submit('Add Job') }}</div>

{{ Form::close() }}

@stop