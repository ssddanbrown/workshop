@extends('common.main')

@section('content')

	{{ Form::open(array('route' => 'settings.users.store')) }}

	<div class="header">
		<h1>{{ link_to_route('settings.index', 'Settings')}} / 
		{{ link_to_route('settings.users', 'Users') }} / New</h1>
		<div class="buttons">
			{{ Form::submit('Save User', array('class' => 'button pos')) }}
		</div>
	</div>

	@include('settings.users.form')

	{{ Form::close() }}

@stop