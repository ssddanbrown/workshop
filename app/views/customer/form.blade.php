
<div class="row-12">
	<div class="row subheader">
		<h3>Details</h3>
	</div>
	<div class="detail">
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name') }}
		{{ $errors->first('name') }}
	</div>
	<div class="detail">
		{{ Form::label('email', 'Email') }}
		{{ Form::text('email') }}
		{{ $errors->first('email') }}
	</div>
	<div class="detail">
		{{ Form::label('phone', 'Phone Number') }}
		{{ Form::text('phone') }}
		{{ $errors->first('phone') }}
	</div>
</div>