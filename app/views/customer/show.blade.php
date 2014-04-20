@extends('common.main')

@section('content')
	
<div class="row-12 header">
	<h1>Customer Record</h1>
	<div class="buttons">
		{{ link_to_route('customers.edit', 'Edit Customer', $customer->id , array('class'=>'button') ) }}
		{{ Form::delete('customers.destroy', 'Delete Customer', $customer->id) }}
	</div>
</div>

<section>
	<div class="half">
		<div class="row subheader">
			<h3>Details</h3>
		</div>
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
	<div class="half">
		<div class="row subheader">
			<h3>Jobs</h3>
		</div>
		<div class="detail">
			<div>OUTSTANDING</div>
			@if( count($customer->jobs) >= 1 )
				@foreach( $customer->jobs as $job )
					@if(!$job->finished)
						<p>{{ link_to_route('jobs.show', $job->title, $job->id, array('class'=>'link')) }}</p>
					@endif
				@endforeach
			@else
				<p>No oustanding jobs.</p>
			@endif
		</div>
		<div class="detail">
			<div>COMPLETE</div>
			@if( count($customer->jobs) >= 1 )
				@foreach( $customer->jobs as $job )
					@if($job->finished)
						<p>{{ link_to_route('jobs.show', $job->title, $job->id, array('class'=>'link')) }}</p>
					@endif
				@endforeach
			@else
				<p>No oustanding jobs.</p>
			@endif
		</div>
	</div>
</section>

	
@stop