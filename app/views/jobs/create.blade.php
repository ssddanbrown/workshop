@extends('common.main')

@section('content')
<div class="row-12">

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
			{{ $errors->first('item_title') }}
			<div>
				{{ Form::label('items[0][item_title]', 'Item Title: ') }}
				{{ Form::text('items[0][item_title]')  }}
			</div>
			<div>
				{{ Form::label('items[0][item_text]', 'Item Description: ') }}
				{{ Form::text('items[0][item_text]') }}
			</div>
			<div>
				{{ Form::label('items[1][item_title]', 'Item Title: ') }}
				{{ Form::text('items[1][item_title]')  }}
			</div>
			<div>
				{{ Form::label('items[1][item_text]', 'Item Description: ') }}
				{{ Form::text('items[1][item_text]') }}
			</div>
		</div>
		<div>
			<h2>Costs</h2>
			{{ $errors->first('cost_qty') }}
			{{ $errors->first('cost_text') }}
			{{ $errors->first('cost_price') }}
			<div>
				{{ Form::label('costs[0][cost_qty]', 'Qty: ') }}
				{{ Form::text('costs[0][cost_qty]')  }}
			</div>
			<div>
				{{ Form::label('costs[0][cost_text]', 'Description: ') }}
				{{ Form::text('costs[0][cost_text]') }}
			</div>
			<div>
				{{ Form::label('costs[0][cost_price]', 'Price: ') }}
				{{ Form::text('costs[0][cost_price]') }}
			</div>
		</div>
		
		<div>{{ Form::submit('Add Job') }}</div>

	{{ Form::close() }}

</div>
@stop