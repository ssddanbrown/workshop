@section('head')
	{{ HTML::script('js/datetime.js')}}
@stop

<section>
	<div class="third details">
		<div class="subheader">
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

	<div class="third details">
		<div class="subheader">
			<h3>Customer</h3>
		</div>

		<div>
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
			<script>
			$(document).ready(function(){

				// Auto Complete
				$('#customer-search-input').autocomplete({
					source: '/customers/search',
					select: function( event, ui ) {
						$('#customer-id').val(ui.item.id);
						$('#customer-current').html(
							ui.item.first_name + ' ' + ui.item.last_name + '<br>' +
							ui.item.email + '<br>' + ui.item.phone
						);
					}
				}).autocomplete( "instance" )._renderItem = function( ul, item ) {
				    return $( "<li>" )
				    .append( "<a>" + item.first_name + ' ' + item.last_name + "<br>" + item.email + "<br>" + item.phone + "</a>" )
				    .appendTo( ul );
				};

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

	</div>
	<div class="third details">
		<div class="subheader">
			<h3>Items</h3>
		</div>
		<div>
			@include('jobs.parts.item-edit-table')
		</div>
	</div>
</section>


<section class="clear details">
	<div class="subheader">
		<h3>Costs</h3>
	</div>
	@include('jobs.parts.cost-edit-table')
</section>