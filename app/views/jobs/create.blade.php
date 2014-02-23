@extends('common.main')

@section('content')

<h1>Add New Job</h1>

{{ Form::open(array('route' => 'jobs.store')) }}

	<div>
		{{ Form::label('title', 'Title:') }}
		{{ Form::text('title') }}
		{{ $errors->first('title') }}
	</div>
	<div>
		{{ Form::label('text', 'Job Notes:') }}
		{{ Form::text('text') }}
		{{ $errors->first('text') }}
	</div>
	<div>
		{{ Form::label('due', 'Date Due:') }}
		{{ Form::input('datetime', 'due', date("Y-m-d H:i:s")) }}
	</div>
	<div>
		<h2>Customer Item</h2>
		<div>
			{{ Form::label('items[0][detail]', 'Details: ') }}
			{{ Form::text('items[0][detail]')  }}
		</div>
		<div>
			{{ Form::label('items[0][text]', 'Description: ') }}
			{{ Form::text('items[0][text]') }}
		</div>
	</div>
	<div>
		<h2>Costs</h2>
		<div>
			{{ Form::label('costs[0][qty]', 'Qty: ') }}
			{{ Form::text('costs[0][qty]')  }}
		</div>
		<div>
			{{ Form::label('costs[0][text]', 'Description: ') }}
			{{ Form::text('costs[0][text]') }}
		</div>
		<div>
			{{ Form::label('costs[0][price]', 'Price: ') }}
			{{ Form::text('costs[0][price]') }}
		</div>
	</div>
	
	<div>{{ Form::submit('Add Job') }}</div>

{{ Form::close() }}

@stop