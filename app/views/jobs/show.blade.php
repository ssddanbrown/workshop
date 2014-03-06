@extends('common.main')

@section('content')
<div class="row">
	
	<h1>Job View</h1>

	<div class="row-12">
			{{ link_to_route( 'jobs.edit', 'Edit Job', $job->id, array('class'=>'button') ) }}
			{{ Form::open( array( 
				'method' 	=> 'DELETE',
				'route' 	=> array('jobs.destroy', $job->id),
				'class'		=> 'inline'
			 )) }}
				{{ Form::submit('Delete Job', array('class'=>'button')) }}
			{{ Form::close() }}
	</div>

	<div class="row-8">
		<div class="row subheader">
			<h3>Details</h3>
		</div>
		<div class="row-6 fill">
			<div class="detail">
				<div>TITLE</div>
				<p>{{ $job->title }}</p>
			</div>
			<div class="detail">
				<div>NOTES</div>
				<p>{{ $job->text }}</p>
			</div>
			<div class="detail">
				<div>ID</div>
				<p>{{ $job->id }}</p>
			</div>
			<div class="detail">
				<div>STATUS</div>
				<p>{{ $job->finished }}</p>
			</div>
		</div>

		<div class="row-6 fill">
			<div class="detail">
				<div>DATE ADDED</div>
				<p>{{ $job->created_at }}</p>
			</div>
			<div class="detail">
				<div>DATE DUE</div>
				<p>{{ $job->due }}</p>
			</div>
			<div class="detail">
				<div>LAST UPDATED</div>
				<p>{{ $job->updated_at }}</p>
			</div>
		</div>
	</div>

	<div class="row-4">
		<div class="row subheader">
			<h3>Customer</h3>
		</div>
		@if($job->customer != null)
			<div class="detail">
				<div>NAME</div>
				<p>{{ $job->customer->name }}</p>
			</div>
			<div class="detail">
				<div>EMAIL</div>
				<p>{{ $job->customer->email }}</p>
			</div>
			<div class="detail">
				<div>PHONE</div>
				<p>{{ $job->customer->phone }}</p>
			</div>
			<div class="detail">
				<p>{{ link_to_route('customers.show', 'View customer record', $job->customer->id) }}</p>
			</div>
		@else
			<p>No customer added.</p>
		@endif
	</div>

	<div class="row"></div>

	<!-- List All Customer Items -->
	<div class="row-6">
		<div class="row subheader">
			<h3>Items</h3>
		</div>
		@if(count($job->items) > 0)
			@foreach($job->items as $item)
					<p><strong>{{ $item->item_title }}</strong><br>
					{{ $item->item_text }}</p>
			@endforeach
			<div class="row"></div>
		@else
			<p>No Items to display.</p>
		@endif
	</div>

	<!-- List All Costs -->
	<div class="row-6">
		<div class="row subheader">
			<h3>Costs</h3>
		</div>
		@if(count($job->costs) > 0)
			@foreach($job->costs as $cost)
				<p><strong>{{ $cost->cost_qty }}</strong>
					{{ $cost->cost_text }} at £{{ sprintf('%0.2f', $cost->cost_price) }} each.
				</p>
			@endforeach
		@else
			<p>No Costs to display.</p>
		@endif
	</div>

</div>
@stop