

<div class="half">
	<div class="row subheader">
		<h3>Details</h3>
	</div>
	<div class="detail">
		{{ Form::label('title', 'Title') }}
		{{ Form::text('title') }}
		{{ $errors->first('title') }}
	</div>
	<div class="detail">
		{{ Form::label('text', 'Description') }}
		{{ Form::textarea('text') }}
		{{ $errors->first('text') }}
	</div>
</div>

<div class="half">
	<div class="row subheader">
		<h3>Typical Time Taken</h3>
	</div>
	<div class="detail">
		<p>Enter the typical time it takes to complete this job.</p>
	</div>
	<div class="detail">
		{{ Form::label('days', 'Days') }}
		{{ Form::text('days') }}
		{{ $errors->first('days') }}
	</div>
	<div class="detail">
		{{ Form::label('hours', 'Hours') }}
		{{ Form::text('hours') }}
		{{ $errors->first('hours') }}
	</div>
	<div class="detail">
		{{ Form::label('mins', 'Minutes') }}
		{{ Form::text('mins') }}
		{{ $errors->first('mins') }}
	</div>
</div>

<div class="row-12">
	<div class="row subheader">
		<h3>Costs</h3>
	</div>
	@include('jobs.parts.cost-edit-table')
</div>