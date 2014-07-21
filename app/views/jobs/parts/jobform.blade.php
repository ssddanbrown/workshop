@section('head')
	{{ HTML::script('js/datetime.js')}}
@stop

<section>
	<div class="third details">
		<h3>Details</h3>
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
		<h3>Customer</h3>

		<div>
			{{ Form::hidden('customer_id', null, array('id'=>'customer-id')) }}

			<table class="nopadding">
				<tbody>
					<td>
						@if( isset($customer) )
							<div id="customer-current" class="padded">
								{{ $customer->name() }} <br>
								{{ $customer->email }} <br>
								{{ $customer->phone }}
							</div>
						@else
							<div id="customer-current" class="padded">No Customer Selected</div>
						@endif
					</td>
					<td>
						<button id="remove-customer-button" type="button" class="delete-circle">X</button>
					</td>
				</tbody>
			</table>
			<div class="detail">
				<label for="customer-search">Search For Customer</label>
				<input id="customer-search" type="text" name="customer-search">
			</div>
			<script>
			$(document).ready(function(){

				// Auto Complete
				$('#customer-search').autocomplete({
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

		<section id="create-customer">
			<div class="detail">
				<label for="">First Name</label>
				<input id="" type="text">
				<span class="error"></span>
			</div>
			<div class="detail">
				<label for="">Last Name</label>
				<input type="text">
				<span class="error"></span>
			</div>
			<div class="detail">
				<label for="">Email</label>
				<input type="text">
				<span class="error"></span>
			</div>
			<div class="detail">
				<label for="">Phone</label>
				<input type="text">
				<span class="error"></span>
			</div>
		</section>

	</div>
	<div class="third details">
		<h3>{{ Setting::get('item_names') }}</h3>
		<div>
			@include('jobs.parts.item-edit-table')
		</div>
	</div>
</section>


<section class="clear details">
	<h3>Costs</h3>
	@include('jobs.parts.cost-edit-table')
</section>