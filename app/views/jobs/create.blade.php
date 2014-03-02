@extends('common.main')

@section('content')
<div class="row-12">
<?php print_r($errors); ?>

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

		<div class="row">
			<h2>Customer Items</h2>
			{{ $errors->first('item_title') }}
			<table>
				<thead>
					<tr>
						<th>{{ Form::label('items[][item_title]', 'Item Title') }}</th>
						<th>{{ Form::label('items[][item_text]', 'Item Description') }}</th>
					</tr>
				</thead>
				<tbody id="item-container">
					@if( count(Form::old('items')) > 1 )

						@foreach(Form::old('items') as $key => $item)
							<tr data-index="{{ $key }}">
								<td>{{ Form::text('items['.$key.'][item_title]')  }}</td>
								<td>{{ Form::text('items['.$key.'][item_text]') }}</td>
							</tr>
						@endforeach

					@else
						<tr data-index="1" >
							<td>{{ Form::text('items[1][item_title]')  }}</td>
							<td>{{ Form::text('items[1][item_text]') }}</td>
						</tr>
					@endif
				</tbody>
			</table>

		</div>
		<a href="javascript:addItem();" class="button-add">Add Item</a>

		<div class="row">
			<h2>Costs</h2>
			{{ $errors->first('cost_qty') }}
			{{ $errors->first('cost_text') }}
			{{ $errors->first('cost_price') }}
			<table>
				<thead>
					<tr>
						<th>{{ Form::label('costs[][cost_qty]', 'Qty: ') }}</th>
						<th>{{ Form::label('costs[][cost_text]', 'Description: ') }}</th>
						<th>{{ Form::label('costs[][cost_price]', 'Price: ') }}</th>
					</tr>
				</thead>
				<tbody id="cost-container">
					@if( count(Form::old('costs')) > 1 )

					@foreach(Form::old('costs') as $key => $cost)
						<tr data-index="{{ $key }}">
							<td>{{ Form::text('costs['.$key.'][cost_qty]')  }}</td>
							<td>{{ Form::text('costs['.$key.'][cost_text]') }}</td>
							<td>{{ Form::text('costs['.$key.'][cost_price]') }}</td>
						</tr>
					@endforeach
						
					@else
						<tr data-index="1">
							<td>{{ Form::text('costs[1][cost_qty]')  }}</td>
							<td>{{ Form::text('costs[1][cost_text]') }}</td>
							<td>{{ Form::text('costs[1][cost_price]') }}</td>
						</tr>
					@endif
				</tbody>
			</table>

		</div>
		<a href="javascript:addCost();" class="button-add">Add Cost</a>
		<p></p>
		
		<div>{{ Form::submit('Add Job') }}</div>

	{{ Form::close() }}

	<script>
	var addItem = function(){
		container = document.getElementById('item-container');
		var containerChildren = container.children;
		var biggestIndex = 0;
		for (var i = 0; i < containerChildren.length; i++) {
			var index = containerChildren[i].getAttribute('data-index');
			index = parseInt(index, 10);
			if (index >= biggestIndex) { biggestIndex = index + 1; }
		};
		var element = document.createElement('tr');
		element.dataset.index = biggestIndex;
		var inner = '<td><input type="text" name="items['+ biggestIndex +'][item_title]" /></td>';
		inner += '<td><input type="text" name="items['+ biggestIndex +'][item_text]" /></td>';
		element.innerHTML = inner;
		container.appendChild(element);
	}

	var addCost = function(){
		container = document.getElementById('cost-container');
		var containerChildren = container.children;
		var biggestIndex = 0;
		for (var i = 0; i < containerChildren.length; i++) {
			var index = containerChildren[i].getAttribute('data-index');
			index = parseInt(index, 10);
			if (index >= biggestIndex) { biggestIndex = index + 1;};
		};
		var element = document.createElement('tr');
		element.dataset.index = biggestIndex;
		var inner = '<td><input type="text" name="costs['+ biggestIndex +'][cost_qty]" /></td>'
		inner += '<td><input type="text" name="costs['+ biggestIndex +'][cost_text]" /></td>'
		inner += '<td><input type="text" name="costs['+ biggestIndex +'][cost_price]" /></td>'
		element.innerHTML = inner;
		container.appendChild(element);
	}
	</script>

</div>
@stop