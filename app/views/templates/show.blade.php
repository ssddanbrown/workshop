@extends('common.main')

@section('content')
	
<div class="header">
	<h1>Template Information</h1>
	<div class="buttons">
		{{ link_to_route('jobs.createfromtemplate', 'New Job', $template->id, array('class' => 'button pos') ) }}
		{{ link_to_route( 'templates.edit', 'Edit', $template->id, array('class'=>'button') ) }}
		{{ Form::delete('jobs.destroy', 'Delete', $template->id) }}
	</div>
</div>

<section>
	<div class="half details">
		<div class="subheader">
			<h3>Details</h3>
		</div>
		<div>
			<div class="detail">
				<div>Title</div>
				<p>{{ $template->title }}</p>
			</div>
			<div class="detail">
				<div>Description</div>
				<p>{{ $template->text }}</p>
			</div>
		</div>
	</div>

	<div class="half details">
		<div class="subheader">
			<h3>Typical Time Taken</h3>
		</div>
		<div>
			<div class="detail">
				<div>Days</div>
				<p>{{ $template->days }}</p>
			</div>
			<div class="detail">
				<div>Hours</div>
				<p>{{ $template->hours }}</p>
			</div>
			<div class="detail">
				<div>Minutes</div>
				<p>{{ $template->mins }}</p>
			</div>
		</div>


</section>

<!-- List All Costs -->
<section class="details">
	<div class="subheader">
		<h3>Costs</h3>
	</div>
	@if(count($template->costs) > 0)
		<table class="table-grid">
			<thead>
				<th>Quantity</th>
				<th>Description</th>
				<th>Price</th>
				<th>Discount</th>
				<th>Total</th>
			</thead>
		@foreach($template->costs as $cost)
			<tr>
				<td>{{ $cost->cost_qty }}</td>
				<td>{{ $cost->cost_text }}</td>
				<td>{{ Format::price($cost->cost_price) }}</td>
				<td>{{ $cost->discount }}%</td>
				<td>{{ $cost->total(true) }}</td>
			</tr>
		@endforeach
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td><strong>Template Total:</strong></td>
				<td>{{ Format::price($template->total) }}</td>
			</tr>
		</table>
	@else
		<p>No Costs to display.</p>
	@endif
</section>

@stop