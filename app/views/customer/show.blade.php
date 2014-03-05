@extends('common.main')

@section('content')
	
	<div class="row-12">
		<h1>Customer Record</h1>
	</div>
	
	<div class="row-6">
		<h2>Details</h2>
		<div class="detail">
			<div>NAME</div>
			<p>{{ $customer->name }}</p>
		</div>
		<div class="detail">
			<div>EMAIL</div>
			<p>{{ $customer->email }}</p>
		</div>
		<div class="detail">
			<div>PHONE</div>
			<p>{{ $customer->phone }}</p>
		</div>
		<div class="detail">
			<div>ID</div>
			<p>{{ $customer->id }}</p>
		</div>
	</div>
	<div class="row-6">
		<h2>Jobs</h2>
		<div class="detail">
			<div>OUTSTANDING</div>
			@if( count($customer->jobs) >= 1 )
				@foreach( $customer->jobs as $job )
					{{ link_to_route('jobs.show', $job->title, $job->id) }}
				@endforeach
			@else
				<p>No oustanding jobs.</p>
			@endif
		</div>
		<div class="detail">
			<div>FINISHED</div>
			<p>No finished jobs</p>
		</div>
	</div>
	<div class="row"></div>
	<p>{{ link_to("customers/{$customer->id}/edit", 'Edit Customer') }}</p>
	<p></p>
	{{ Form::open( array('method' => 'DELETE', 'route' => array('customers.destroy', $customer->id ) ) ) }}
		{{ Form::submit('Delete Customer') }}
	{{ Form::close() }}
	
@stop