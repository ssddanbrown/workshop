@section('head')
	{{ HTML::script('js/datetime.js')}}
@stop

<section>
	<div class="third">
		<div class="row subheader">
			<h3>Details</h3>
		</div>
		<div class="detail">
			{{ Form::label('title', 'Title') }}
			{{ Form::text('title') }}
			{{ $errors->first('title') }}
		</div>
		<div class="detail">
			{{ Form::label('due', 'Date Due') }}
			@if( isset($job) )
				{{ Form::text('due', Format::date($job->due), ['class'=>'datetime'] ) }}
			@else
				{{ Form::text('due', Format::date(), ['class'=>'datetime'] ) }}
			@endif
			{{ $errors->first('due') }}
		</div>
		<div class="detail">
			{{ Form::label('text', 'Description') }}
			{{ Form::textArea('text') }}
			{{ $errors->first('text') }}
		</div>
	</div>

	<div class="third">
			<div class="row subheader">
			<h3>Customer</h3>
		</div>

		{{ Form::hidden('customer_id', null, array('id'=>'customer-id')) }}

		<table class="nopadding">
			<tbody>
				<td>
					@if( isset($customer) )
						<div id="customer-current">
							{{ $customer->name() }} <br>
							{{ $customer->email }} <br>
							{{ $customer->phone }}
						</div>
					@else
						<div id="customer-current">No Customer Selected</div>
					@endif
				</td>
				<td>
					<button id="remove-customer-button" type="button" class="delete-circle">X</button>
				</td>
			</tbody>
		</table>

		<input id="customer-search-input" type="text" name="customer-search">
		<button class="button" type="button" id="customer-search-button">Search</button>
		<div id="customer-display-wrapper">
			<div id="customer-display"></div>
		</div>
		<script>
		$(document).ready(function(){

			// Main AJAX search function
			function search(){
				var input = $('#customer-search-input').val();
				var display = $('#customer-display');
				display.empty();
				var request = $.ajax({
					url: '/customers/search',
					type: 'post',
					data: { term: input},
					dataType: 'json'
				});
				// ADD STATUS INDICATOR
				request.done( function( data ){
					$.each( data, function(index, customer){
						var inner = '<button type="button" class="customer-result" data-id="' + customer.id +'">';
						inner += customer.first_name + ' ' + customer.last_name + '<br>';
						inner += customer.email + '<br>';
						inner += customer.phone + '</button type="button">'
						display.append( inner );
					});
				});
			}

			// Search on button click or enter press
			$('#customer-search-button').click(search);
			$('#customer-search-input').keypress(function (e){
				if ( e.which == 13 ) {
					search();
					return false;
				};
			});

			// Search results click event
			$('#customer-display').on('click', '.customer-result', function(){
				var display = $('#customer-current');
				var id = $(this).data('id');
				$('#customer-id').val(id);
				display.html($(this).html());
				$('#remove-customer-button').show();
			});

			// Remove customer button
			$('#remove-customer-button').click(function(){
				var display = $('#customer-current');
				$('#customer-id').val(0);
				display.html('No Customer Selected');
				$(this).hide();
			});
			// Hide on load if customer not set
			if( $('#customer-id').val() ==  0){
				$('#remove-customer-button').hide();
			}

		});
		</script>
	</div>
	<div class="third">
		<div class="row subheader">
			<h3>Items</h3>
		</div>
		@include('jobs.parts.item-edit-table')
	</div>
</section>


<section class="clear">
	<div class="row subheader">
		<h3>Costs</h3>
	</div>
	@include('jobs.parts.cost-edit-table')
</section>