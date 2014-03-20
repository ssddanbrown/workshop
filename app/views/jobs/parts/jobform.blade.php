
{{ Form::hidden('customer_id') }}

<div class="row-4">
	<div class="row subheader">
		<h3>Details</h3>
	</div>
	<div class="detail">
		{{ Form::label('title', 'Title') }}
		{{ Form::text('title') }}
		{{ $errors->first('title') }}
	</div>
	<div class="detail">
		{{ Form::label('text', 'Job Notes') }}
		{{ Form::text('text') }}
		{{ $errors->first('text') }}
	</div>
	<div class="detail">
		{{ Form::label('due', 'Date Due') }}
		@if( isset($job) )
			{{ Form::input('datetime', 'due') }}
		@else
			{{ Form::input('datetime', 'due', date("Y-m-d H:i:s")) }}
		@endif
	</div>
</div>

<div class="row-4">
		<div class="row subheader">
		<h3>Customer</h3>
	</div>
	@if( isset($customer) )
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
	@else
		<p>No customer Set</p>
	@endif
	@if( isset($job) )
		{{ link_to_route('jobs.editcustomer', 'Change Customer', $job->id, array('class'=>'button')) }}
	@endif
</div>

<div class="row-4">
	<div class="row subheader">
		<h3>Items</h3>
	</div>
	@include('jobs.parts.item-edit-table')
</div>


<div class="row-12">
	<div class="row subheader">
		<h3>Costs</h3>
	</div>
	@include('jobs.parts.cost-edit-table')
</div>