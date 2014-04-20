@extends('common.main')

@section('content')

	<div class="row-12 header">
		<h1>Customers</h1>
		<div class="buttons">
			{{ link_to_route('customers.create', 'New Customer',null, array('class'=>'button pos right') ) }}
		</div>	
	</div>

	<div class="row-12">
		@if ( count($customers) >= 1 )
			<table class="table-grid">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>E-mail</th>
						<th>Phone</th>
					</tr>
				</thead>
				<tbody>
					@foreach ( $customers as $customer )
						<tr>
							<td>{{ $customer->id }}</td>
							<td>{{ link_to_route('customers.show', $customer->name(), $customer->id) }}</td>
							<td>{{ $customer->email }}</td>
							<td>{{ $customer->phone }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p>No customers to display....</p>
		@endif
	</div>
	
@stop