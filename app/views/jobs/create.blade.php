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
			<div id="item-container" class="row">
				<div id="item-model" class="item row-6">
					<div>
						{{ Form::label('items[0][item_title]', 'Item Title: ') }}
						{{ Form::text('items[0][item_title]')  }}
					</div>
					<div>
						{{ Form::label('items[0][item_text]', 'Item Description: ') }}
						{{ Form::text('items[0][item_text]') }}
					</div>
					<p></p>
				</div>
			</div>

		</div>
		<a href="javascript:addForm('item');" class="button-add">Add Item</a>
		<?php dd(Cache::get('title')); ?>
		<div class="row">
			<h2>Costs</h2>
			{{ $errors->first('cost_qty') }}
			{{ $errors->first('cost_text') }}
			{{ $errors->first('cost_price') }}
			<div id="cost-container">
				<div id="cost-model" class="cost row-6">
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
					<p></p>
				</div>
			</div>
		</div>
		<a href="javascript:addForm('cost');" class="button-add">Add Cost</a>
		<p></p>
		
		<div>{{ Form::submit('Add Job') }}</div>

	{{ Form::close() }}

	<script>
	var addForm = function(name){
		var index = document.getElementById(name + '-container').children.length;
		var html = document.getElementById(name + '-model').innerHTML;
		html = html.replace(/\[0\]/g, "[" + index + "]");
		var element = document.createElement('div');
		element.className = name + " row-6";
		element.innerHTML = html;
		document.getElementById(name + '-container').appendChild(element);
	}
	</script>

</div>
@stop