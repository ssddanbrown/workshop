@extends('common.public')

@section('content')

	{{ Form::open(array('route' => 'login.attempt')) }}

	<section>
		<div class="details half">
			<div class="subheader">
				<h3>ADMIN LOGIN</h3>
			</div>
			<div class="detail">
				<div>Username</div>
				{{ Form::text('username') }}
			</div>
			<div class="detail">
				<div>Password</div>
				{{ Form::password('password') }}
			</div>
			<p>{{ $errors->first('password') }}</p>
			<div class="detail">
				{{ Form::submit('Login', array('class' => 'button pos')) }}
			</div>
		</div>
	</section>

	{{ Form::close() }}

@stop