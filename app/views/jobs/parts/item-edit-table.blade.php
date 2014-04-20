{{ $errors->first('item_title') }}
<table class="edit">
	<thead>
		<tr class="table-row">
			<th>{{ Form::label('items[][item_title]', 'Item Title') }}</th>
			<th>{{ Form::label('items[][item_text]', 'Item Description') }}</th>
			<th></th>
		</tr>
	</thead>
	<tbody id="item-container">
		@if( count(Form::old('items')) > 0 )

			@foreach(Form::old('items') as $key => $item)
				<tr class="table-row" data-index="{{ $key }}">
					<td>{{ Form::text('items['.$key.'][item_title]')  }}</td>
					<td>{{ Form::text('items['.$key.'][item_text]') }}</td>
					<td><button type="button" class="delete-row">X</button></td>
				</tr>
			@endforeach

		@elseif( isset($job) && count($job->items) > 0)

			@foreach($job->items as $item)
				<tr class="table-row" data-index="{{ $item->id }}">
					<td>{{ Form::text('items['.$item->id.'][item_title]', $item->item_title)  }}</td>
					<td>{{ Form::text('items['.$item->id.'][item_text]', $item->item_text) }}</td>
					<td><button type="button" class="delete-row">X</button></td>
				</tr>
			@endforeach

		@else
			<tr class="table-row" data-index="1" >
				<td>{{ Form::text('items[1][item_title]')  }}</td>
				<td>{{ Form::text('items[1][item_text]') }}</td>
				<td><button type="button" class="delete-row">X</button></td>
			</tr>
		@endif
	</tbody>
</table>
<button type="button" onclick="addForm('item');" class="button">Add Item</button>