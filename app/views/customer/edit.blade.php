@extends('common.main')

@section('content')

	{{ Form::model($customer, array('method' => 'PUT', 'route' => array('customers.update', $customer->id) )) }}

	<div class="row-12 header">
		<h1>Edit Customer</h1>
		<div class="buttons">
			{{ Form::submit('Save Customer', array('class'=>'button') ) }}
		</div>
	</div>

		@include('customer.form')

	{{ Form::close() }}

@stop