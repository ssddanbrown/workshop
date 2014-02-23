@extends('common.main')

@section('content')

<h1>Edit Customer</h1>
 
{{ Form::model($customer, array('method' => 'PUT', 'route' => array('customers.update', $customer->id) )) }}

	@include('customer.form')

	<div>{{ Form::submit('Save Customer') }}</div>

{{ Form::close() }}

@stop