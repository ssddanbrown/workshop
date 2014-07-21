@extends('common.main')

@section('content')
	
<div class="header">
	<h1>{{ link_to_route('settings.index', 'Settings')}} /
		{{ link_to_route('settings.users', 'Users') }} / 
		{{ $user->first_name }}</h1>
	<div class="buttons">
		{{ link_to_route('settings.users.edit', 'Edit User', $user->id, array('class' => 'button')) }}
		{{ Form::delete('settings.users.destroy', 'Delete User', $user->id) }}
	</div>
</div>

<section>
	<div class="details">
		<h3>Details</h3>
		<div class="detail">
			<div>First Name</div>
			<p>{{ $user->first_name }}</p>
		</div>
		<div class="detail">
			<div>Last Name</div>
			<p>{{ $user->last_name }}</p>
		</div>
		<div class="detail">
			<div>Email</div>
			<p>{{ $user->email }}</p>
		</div>
		<div class="detail">
			<div>ID</div>
			<p>{{ $user->id }}</p>
		</div>
	</div>
</section>

	
@stop