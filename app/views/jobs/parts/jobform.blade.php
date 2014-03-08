
<div class="row-6">
	<div class="row subheader">
		<h3>Details</h3>
	</div>
	<div class="detail">
		{{ Form::label('title', 'Title') }}
		{{ Form::text('title') }}
		{{ $errors->first('title') }}
	</div>
	<div class="detail">
		{{ Form::label('text', 'Job Notes') }}
		{{ Form::text('text') }}
		{{ $errors->first('text') }}
	</div>
	<div class="detail">
		{{ Form::label('due', 'Date Due') }}
		{{ Form::input('datetime', 'due', date("Y-m-d H:i:s")) }}
	</div>
	<div class="detail">
	{{ Form::label('customer_id', 'Customer') }}
	{{ Form::select('customer_id', $customers) }}
	</div>
</div>

<div class="row-6">
	<div class="row subheader">
		<h3>Items</h3>
	</div>
	{{ $errors->first('item_title') }}
	<table class="edit">
		<thead>
			<tr>
				<th>{{ Form::label('items[][item_title]', 'Item Title') }}</th>
				<th>{{ Form::label('items[][item_text]', 'Item Description') }}</th>
			</tr>
		</thead>
		<tbody id="item-container">
			@if( count(Form::old('items')) > 0 )

				@foreach(Form::old('items') as $key => $item)
					<tr data-index="{{ $key }}">
						<td>{{ Form::text('items['.$key.'][item_title]')  }}</td>
						<td>{{ Form::text('items['.$key.'][item_text]') }}</td>
					</tr>
				@endforeach

			@elseif( isset($job) && count($job->items) > 0)

				@foreach($job->items as $item)
					<tr data-index="{{ $item->id }}">
						<td>{{ Form::text('items['.$item->id.'][item_title]', $item->item_title)  }}</td>
						<td>{{ Form::text('items['.$item->id.'][item_text]', $item->item_text) }}</td>
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
<a href="javascript:addForm('item');" class="button">Add Item</a>
</div>


<div class="row-12">
	<h2>Costs</h2>
	{{ $errors->first('cost_qty') }}
	{{ $errors->first('cost_text') }}
	{{ $errors->first('cost_price') }}
	<table class="edit">
		<thead>
			<tr>
				<th>{{ Form::label('costs[][cost_qty]', 'Qty: ') }}</th>
				<th>{{ Form::label('costs[][cost_text]', 'Description: ') }}</th>
				<th>{{ Form::label('costs[][cost_price]', 'Price: ') }}</th>
			</tr>
		</thead>
		<tbody id="cost-container">
			@if( count(Form::old('costs')) > 0 )

				@foreach(Form::old('costs') as $key => $cost)
					<tr data-index="{{ $key }}">
						<td>{{ Form::text('costs['.$key.'][cost_qty]')  }}</td>
						<td>{{ Form::text('costs['.$key.'][cost_text]') }}</td>
						<td>{{ Form::text('costs['.$key.'][cost_price]') }}</td>
					</tr>
				@endforeach
				
			@elseif( isset($job) && count($job->costs) > 0 )
				
				@foreach( $job->costs as $cost)
					<tr data-index="{{ $cost->id }}">
						<td>{{ Form::text('costs['.$cost->id.'][cost_qty]', $cost->cost_qty)  }}</td>
						<td>{{ Form::text('costs['.$cost->id.'][cost_text]', $cost->cost_text) }}</td>
						<td>{{ Form::text('costs['.$cost->id.'][cost_price]', $cost->cost_price) }}</td>
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
	<a href="javascript:addForm('cost');" class="button">Add Cost</a>
</div>