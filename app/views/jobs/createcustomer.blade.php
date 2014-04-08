@extends('common.main')

@section('content')

	{{ Form::open(array('route' => 'jobs.customertojob')) }}

		<div class="row-12 header">
			<h1>Select Customer</h1>
			<div class="buttons">
				<div class="radio">
					{{ Form::radio('customer_id', 0, true, array('id'=>'radio_default') ) }}
					{{ Form::label('radio_default', 'No Customer') }}
				</div>
				{{ Form::submit('Continue', array('class'=>'button') ) }}
			</div>
		</div>

		@include('jobs.parts.customerform')

	{{ Form::close() }}

@stop