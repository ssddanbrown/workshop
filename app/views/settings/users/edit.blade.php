@extends('common.main')

@section('content')

	{{ Form::model($user, array('method' => 'PUT', 'route' => array('settings.users.update', $user->id))) }}

	<div class="header">
		<h1>{{ link_to_route('settings.index', 'Settings')}} / 
		{{ link_to_route('settings.users', 'Users') }} / Edit {{ $user->first_name }}</h1>
		<div class="buttons">
			{{ Form::submit('Save User', array('class' => 'button pos')) }}
		</div>
	</div>

	@include('settings.users.form')

	{{ Form::close() }}

@stop