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

		<div class="row-12">
			<table class="table-grid">
				<thead>
					<th>Select</th>
					<th>Customer Name</th>
				</thead>
				<tbody>
					@if( count($customers) > 0 )
					@foreach( $customers as $customer)
						
						<tr>
							<td>
								{{ Form::radio('customer_id', $customer->id) }}
							</td>
							<td>
								{{ $customer->name() }}
							</td>
						</tr>

					@endforeach
					@endif
				</tbody>
			</table>
			{{ $customers->links() }}
		</div>

	{{ Form::close() }}

@stop