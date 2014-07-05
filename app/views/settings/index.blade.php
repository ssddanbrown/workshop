@extends('common.main')

@section('content')

	<div class="header">
		<h1>Settings</h1>
	</div>

	<p>
		{{ link_to_route('settings.states', 'Edit Job Statuses') }}
	</p>

@stop