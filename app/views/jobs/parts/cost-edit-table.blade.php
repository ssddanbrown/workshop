
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
		</tr>
	</thead>
	<tbody id="cost-container">
		@if( count(Form::old('costs')) > 0 )

			@foreach(Form::old('costs') as $key => $cost)
				<tr data-index="{{ $key }}">
					<td>{{ Form::text('costs['.$key.'][cost_qty]')  }}</td>
					<td>{{ Form::text('costs['.$key.'][cost_text]') }}</td>
					<td>{{ Form::text('costs['.$key.'][cost_price]') }}</td>
					<td>{{ Form::text('costs['.$key.'][discount]') }}</td>
				</tr>
			@endforeach
			
		@elseif( isset($job) && count($job->costs) > 0 )
			
			<!-- Section repeated below -->
			@foreach( $job->costs as $cost )
				<tr data-index="{{ $cost->id }}">
					<td>{{ Form::text('costs['.$cost->id.'][cost_qty]', $cost->cost_qty)  }}</td>
					<td>{{ Form::text('costs['.$cost->id.'][cost_text]', $cost->cost_text) }}</td>
					<td>{{ Form::text('costs['.$cost->id.'][cost_price]', $cost->cost_price) }}</td>
					<td>{{ Form::text('costs['.$cost->id.'][discount]', $cost->discount) }}</td>
				</tr>
			@endforeach

		@elseif( isset($template) && count($template->costs) > 0 )
			
			<!-- Repeats section above -->
			@foreach( $template->costs as $cost )
				<tr data-index="{{ $cost->id }}">
					<td>{{ Form::text('costs['.$cost->id.'][cost_qty]', $cost->cost_qty)  }}</td>
					<td>{{ Form::text('costs['.$cost->id.'][cost_text]', $cost->cost_text) }}</td>
					<td>{{ Form::text('costs['.$cost->id.'][cost_price]', $cost->cost_price) }}</td>
					<td>{{ Form::text('costs['.$cost->id.'][discount]', $cost->discount) }}</td>
				</tr>
			@endforeach

		@else

			<tr data-index="1">
				<td>{{ Form::text('costs[1][cost_qty]')  }}</td>
				<td>{{ Form::text('costs[1][cost_text]') }}</td>
				<td>{{ Form::text('costs[1][cost_price]') }}</td>
				<td>{{ Form::text('costs[1][discount]') }}</td>
			</tr>

		@endif
	</tbody>
</table>
<a href="javascript:addForm('cost');" class="button">Add Cost</a>