@extends('common.main')

@section('content')

<h1>Add New Customer</h1>
 
{{ Form::open(array('route' => 'customers.store')) }}

	@include('customer.form')

	<div>{{ Form::submit('Add Customer') }}</div>

{{ Form::close() }}

@stop