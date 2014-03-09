
<div class="row-12">
	<table class="table-grid">
		<thead>
			<th>Select</th>
			<th>Customer Name</th>
		</thead>
		<tbody>
			@if( count($customers) > 0 )
			@foreach( $customers as $customer)
				
				<tr>
					<td>
						{{ Form::radio('customer_id', $customer->id) }}
					</td>
					<td>
						{{ $customer->name() }}
					</td>
				</tr>

			@endforeach
			@endif
		</tbody>
	</table>
	{{ $customers->links() }}
</div>