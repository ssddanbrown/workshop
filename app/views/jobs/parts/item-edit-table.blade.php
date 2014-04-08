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