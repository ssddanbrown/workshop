@extends('common.main')

@section('content')

	<div class="header">
		<h1>{{ link_to_route('settings.index', 'Settings')}} /
		{{ link_to_route('settings.states', 'Job Statuses') }} / Delete</h1>
	</div>

	<h2>Delete Status "{{$state->name}}" ?</h2>

	<p>This status has jobs assigned to it.<br>Please select a status to transfer jobs to.</p>
	
	{{ Form::open(array('route' => array('settings.states.delete', $state->id), 'method' => 'DELETE')) }}

	{{ Form::select('newid', $states) }}

	<div class="buttons">
		{{ link_to_route('settings.states', 'Cancel', null, array('class'=>'button')) }}
		{{ Form::submit('Transfer & Delete', array('class'=>'button neg')) }}
	</div>

	{{ Form::close() }}
@stop