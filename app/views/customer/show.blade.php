@extends('common.main')

@section('content')
	
<div class="header">
	<h1>Customer Record</h1>
	<div class="buttons">
		{{ link_to_route('customers.edit', 'Edit Customer', $customer->id , array('class'=>'button') ) }}
		{{ Form::delete('customers.destroy', 'Delete Customer', $customer->id) }}
	</div>
</div>

<section>
	<div class="half details">
		<h3>Details</h3>
		<div class="detail">
			<div>NAME</div>
			<p>{{ $customer->name() }}</p>
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
	<div class="half details">
		<h3>Jobs</h3>
		<div class="detail">
			<div>All Jobs Assigned To Customer</div>
			@if( count($customer->jobs) > 0 )

				@foreach( $customer->jobs as $job )
					<p>{{ link_to_route('jobs.show', $job->title, $job->id, array('class'=>'link')) }}</p>
				@endforeach

			@else
				<p>No jobs.</p>
			@endif
		</div>
	</div>
</section>

	
@stop