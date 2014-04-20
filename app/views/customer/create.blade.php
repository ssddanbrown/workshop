@extends('common.main')

@section('content')
 
	{{ Form::open(array('route' => 'customers.store')) }}

		<div class="row-12 header">
			<h1>Add New Customer</h1>
			<div class="buttons">
				{{ Form::submit('Save Customer', array('class'=>'button pos') ) }}
			</div>
		</div>

		@include('customer.form')

	{{ Form::close() }}

@stop