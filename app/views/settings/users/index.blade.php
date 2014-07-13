@extends('common.main')

@section('content')

	<div class="header">
		<h1>{{ link_to_route('settings.index', 'Settings')}} / Users</h1>
		<div class="buttons">
			{{ link_to_route('settings.users.create', 'Add User', null, array('class' => 'button pos')) }}
		</div>
	</div>

	@if(count($users) > 0)
		<table class="table-grid">
			<thead>
				<tr>
					<th>Username</th>
					<th>Name</th>
					<th>Email</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach( $users as $user )
					
					<tr>
						<td>{{ link_to_route('settings.users.show', $user->username, $user->id) }}</td>
						<td>{{ $user->name() }}</td>
						<td>{{ $user->email }}</td>
						<td>
							{{ link_to_route('settings.users.edit', 'Edit User', $user->id, array('class' => 'button')) }}
							{{ Form::delete('settings.users.destroy','Delete User', $user->id) }}
						</td>
					</tr>

				@endforeach
			</tbody>
		</table>
	@else
		<p>No users to display</p>
	@endif
	
@stop