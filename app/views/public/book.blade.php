@extends('common.public')

@section('head')
	{{ HTML::script('js/datetime.js')}}
@stop


@section('content')

	<h1>Book "{{ $template->title }}"</h1>
	<h3 class="subtitle">This job will take approximately {{ $template->humanTime() }}</h3>

	{{ Form::open(array('route'=>'booking.store')) }}
	{{ Form::hidden('template_id', $template->id) }}

	<div class="detail">
		{{ Form::label('first_name', 'First Name') }}
		{{ Form::text('first_name') }}
		<span class="error">{{ $errors->first('first_name') }}</span>
	</div>
	<div class="detail">
		{{ Form::label('last_name', 'Last Name') }}
		{{ Form::text('last_name') }}
		<span class="error">{{ $errors->first('last_name') }}</span>
	</div>
	<div class="detail">
		{{ Form::label('email', 'Email') }}
		{{ Form::text('email') }}
		<span class="error">{{ $errors->first('email') }}</span>
	</div>
	<div class="detail">
		{{ Form::label('phone', 'Phone') }}
		{{ Form::text('phone') }}
		<span class="error">{{ $errors->first('phone') }}</span>
	</div>
	<div class="detail">
		{{ Form::label('time', 'time') }}
		{{ Form::text('time', Format::date(), array('class'=>'datetime')) }}
		<span class="error">{{ $errors->first('time') }}</span>
	</div>
	<div class="detail">
		{{ Form::submit('Submit Job Request', array('class'=>'button pos')) }}
	</div>

	{{ Form::close() }}
	
	
@stop