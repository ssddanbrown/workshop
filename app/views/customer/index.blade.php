@extends('common.main')

@section('content')
	<h1>Customers</h1>
	@if ( count($customers) >= 1 )
		@foreach ( $customers as $customer )
			<li>{{ link_to("/customers/{$customer->id}", $customer->name ) }}</li>
		@endforeach
	@else
		<p>No customers to display....</p>
	@endif

	<p>{{ link_to("/customers/create", 'New Customer') }}</p>

@stop