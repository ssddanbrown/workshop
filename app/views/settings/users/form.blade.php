
<div class="details">
	<div class="row subheader">
		<h3>User Details</h3>
	</div>
	<div class="detail">
		{{ Form::label('first_name', 'First Name') }}
		{{ Form::text('first_name') }}
		{{ $errors->first('first_name') }}
	</div>
	<div class="detail">
		{{ Form::label('last_name', 'Last Name') }}
		{{ Form::text('last_name') }}
		{{ $errors->first('last_name') }}
	</div>
	<div class="detail">
		{{ Form::label('email', 'Email') }}
		{{ Form::text('email') }}
		{{ $errors->first('email') }}
	</div>
	<div class="detail">
		{{ Form::label('password', 'Password') }}
		{{ Form::password('password') }}
		{{ $errors->first('password') }}
	</div>
	<div class="detail">
		{{ Form::label('password_check', 'Repeat Password') }}
		{{ Form::password('password_check') }}
		{{ $errors->first('password_check') }}
	</div>
</div>