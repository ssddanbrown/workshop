@extends('common.main')

@section('content')

	{{ Form::model($customer, array('method' => 'PUT', 'route' => array('customers.update', $customer->id) )) }}

	<div class="header">
		<h1>Edit Customer</h1>
		<div class="buttons">
			{{ Form::submit('Save Customer', array('class'=>'button pos') ) }}
		</div>
	</div>

	@include('customer.form')

	{{ Form::close() }}

@stop