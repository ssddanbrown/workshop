@extends('common.main')

@section('content')
<div class="row-12">

	<h1>Customers</h1>

	<div class="row subheader">
		<h3>All Current Customers</h3>
		{{ link_to("/customers/create", 'New Customer', array('class'=>'button right') ) }}
	</div>

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
						<td>{{ link_to_route('customers.show', $customer->name, $customer->id) }}</td>
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