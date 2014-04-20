
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

	<div class="third">
			<div class="row subheader">
			<h3>Customer</h3>
		</div>
		{{ Form::hidden('customer_id', null, array('id'=>'customer-id')) }}
		@if( isset($customer) )
			<div id="customer-current">
				{{ $customer->name() }} <br>
				{{ $customer->email }} <br>
				{{ $customer->phone }}
			</div>
		@else
			<div id="customer-current">No Customer Selected</div>
		@endif
		<input id="customer-search-input" type="text" name="customer-search">
		<div id="customer-search-button" class="button">Search</div>
		<div id="customer-display"></div>
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
						var inner = '<div class="customer-result" data-id="' + customer.id +'">';
						inner += customer.first_name + ' ' + customer.last_name + '<br>';
						inner += customer.email + '<br>';
						inner += customer.phone + '</div>'
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
			});

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