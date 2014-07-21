
<section>
	<div class="half details">
		<h3>Details</h3>
		<div class="detail">
			{{ Form::label('title', 'Title') }}
			{{ Form::text('title') }}
			{{ $errors->first('title') }}
		</div>
		<div class="detail">
			{{ Form::label('public', 'Visible to Public') }}
			{{ Form::checkbox('public', true) }}
		</div>
		<div class="detail">
			{{ Form::label('text', 'Description') }}
			{{ Form::textarea('text') }}
			{{ $errors->first('text') }}
		</div>
	</div>

	<div class="half details">
		<h3>Typical Time Taken</h3>
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
</section>


<section class="details">
	<h3>Costs</h3>
	@include('jobs.parts.cost-edit-table')
</section>