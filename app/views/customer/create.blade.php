@extends('common.main')

@section('content')
<div class="row-12">

	<h1>Add New Customer</h1>
 
	{{ Form::open(array('route' => 'customers.store')) }}

		@include('customer.form')

		<div>{{ Form::submit('Add Customer') }}</div>

	{{ Form::close() }}

</div>
@stop