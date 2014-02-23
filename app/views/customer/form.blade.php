

<div>
	{{ Form::label('name', 'Name:') }}
	{{ Form::text('name') }}
	{{ $errors->first('name') }}
</div>

<div>
	{{ Form::label('email', 'Email:') }}
	{{ Form::text('email') }}
	{{ $errors->first('email') }}
</div>

<div>
	{{ Form::label('phone', 'Phone Number:') }}
	{{ Form::text('phone') }}
	{{ $errors->first('phone') }}
</div>