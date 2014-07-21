
{{ $errors->first('cost_qty') }}
{{ $errors->first('cost_text') }}
{{ $errors->first('cost_price') }}
{{ $errors->first('discount') }}
<table class="table-grid">
	<thead>
		<tr>
			<th>{{ Form::label('costs[][cost_qty]', 'Qty') }}</th>
			<th>{{ Form::label('costs[][cost_text]', 'Description') }}</th>
			<th>{{ Form::label('costs[][cost_price]', 'Price') }}</th>
			<th>{{ Form::label('costs[][discount]', 'Discount') }}</th>
			<th class="number">Total</th>
			<th></th>
		</tr>
	</thead>
	<tbody id="cost-container">

		<tr class="table-row model" style="display: none;" data-index="-1">
			<td>{{ Form::text('costs[-1][cost_qty]', null, ['disabled'=>'true'])  }}</td>
			<td>{{ Form::text('costs[-1][cost_text]', null, ['disabled'=>'true']) }}</td>
			<td>{{ Form::text('costs[-1][cost_price]', null, ['disabled'=>'true']) }}</td>
			<td>{{ Form::text('costs[-1][discount]', null, ['disabled'=>'true']) }}</td>
			<td class="number"><span class="total">£0.00</span></td>
			<td><button type="button" class="delete-row">X</button></td>
		</tr>

		@if( count(Form::old('costs')) > 0 )

			@foreach(Form::old('costs') as $key => $cost)
				<tr class="table-row"  data-index="{{ $key }}">
					<td>{{ Form::text('costs['.$key.'][cost_qty]')  }}</td>
					<td>{{ Form::text('costs['.$key.'][cost_text]') }}</td>
					<td>{{ Form::text('costs['.$key.'][cost_price]') }}</td>
					<td>{{ Form::text('costs['.$key.'][discount]') }}</td>
					<td class="number"><span class="total"></span></td>
					<td><button type="button" class="delete-row">X</button></td>
				</tr>
			@endforeach
			
		@elseif( isset($job) && count($job->costs) > 0 )
			
			<!-- Section repeated below -->
			@foreach( $job->costs as $cost )
				<tr class="table-row"  data-index="{{ $cost->id }}">
					<td>{{ Form::text('costs['.$cost->id.'][cost_qty]', $cost->cost_qty)  }}</td>
					<td>{{ Form::text('costs['.$cost->id.'][cost_text]', $cost->cost_text) }}</td>
					<td>{{ Form::text('costs['.$cost->id.'][cost_price]', $cost->cost_price) }}</td>
					<td>{{ Form::text('costs['.$cost->id.'][discount]', $cost->discount) }}</td>
					<td class="number"><span class="total">{{ $cost->total(true) }}</span></td>
					<td><button type="button" class="delete-row">X</button></td>
				</tr>
			@endforeach

		@elseif( isset($template) && count($template->costs) > 0 )
			
			<!-- Repeats section above -->
			@foreach( $template->costs as $cost )
				<tr class="table-row"  data-index="{{ $cost->id }}">
					<td>{{ Form::text('costs['.$cost->id.'][cost_qty]', $cost->cost_qty)  }}</td>
					<td>{{ Form::text('costs['.$cost->id.'][cost_text]', $cost->cost_text) }}</td>
					<td>{{ Form::text('costs['.$cost->id.'][cost_price]', $cost->cost_price) }}</td>
					<td>{{ Form::text('costs['.$cost->id.'][discount]', $cost->discount) }}</td>
					<td class="number"><span class="total">{{ $cost->total(true) }}</span></td>
					<td><button type="button" class="delete-row">X</button></td>
				</tr>
			@endforeach

		@endif

		@if( count(Form::old('costs')) == 0 )
			<tr class="table-row" data-index="0">
				<td>{{ Form::text('costs[0][cost_qty]')  }}</td>
				<td>{{ Form::text('costs[0][cost_text]') }}</td>
				<td>{{ Form::text('costs[0][cost_price]') }}</td>
				<td>{{ Form::text('costs[0][discount]') }}</td>
				<td class="number"><span class="total">£0.00</span></td>
				<td><button type="button" class="delete-row">X</button></td>
			</tr>
		@endif

	</tbody>
</table>
<div class="padded">
	<button type="button" id="button-add-cost" class="button">Add Cost</button>
</div>


<script>
$(document).ready(function(){

	// Live Cost Table Updater
	$('#cost-container').on( 'input', '.table-row input', function(){
		var inputs = $(this).parent().parent().find('input');
		var quantity = parseFloat( inputs.eq(0).val() );
		quantity = ( isNaN(quantity) ? 0 : quantity );
		var price = parseFloat( inputs.eq(2).val() );
		price = ( isNaN(price) ? 0 : price );
		var discount = parseFloat( inputs.eq(3).val() );
		discount = ( isNaN(discount) ? 0 : discount );
		var total = (quantity * price) * ((100-discount)/100);
		$(this).parent().parent().find('.total').text('£'+ total.toFixed(2));
	});

});
</script>