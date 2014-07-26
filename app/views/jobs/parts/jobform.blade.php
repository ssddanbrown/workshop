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

		{{ Form::hidden('customer_id', null, array('id'=>'customer-id')) }}

		<table class="nopadding" >
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
		<section id="customer-search">
			<div class="detail">
				<label for="customer-search-input">Search For Customer</label>
				<input id="customer-search-input" type="text" name="customer-search-input">
			</div>
			<script>
			$(document).ready(function(){

				// Auto Complete
				$('#customer-search-input').autocomplete({
					source: '/customers/search',
					select: function( event, ui ) {
						$('#customer-id').val(ui.item.id);
						$('#remove-customer-button').show();
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
		</section>
		
		<div class="detail">
			<button type="button" id="hide-search" data-search="true" class="button">Add New Customer</button>
		</div>
		
		<section id="customer-create" class="hidden">
			<h3>Add New Customer</h3>
			<div class="detail">
				{{ Form::label('customer[first_name]', 'First Name') }}
				{{ Form::text('customer[first_name]') }}
				<span class="error" id="first_name"></span>
			</div>
			<div class="detail">
				{{ Form::label('customer[last_name]', 'Last Name') }}
				{{ Form::text('customer[last_name]') }}
				<span class="error" id="last_name"></span>
			</div>
			<div class="detail">
				{{ Form::label('customer[email]', 'Email') }}
				{{ Form::text('customer[email]') }}
				<span class="error" id="email"></span>
			</div>
			<div class="detail">
				{{ Form::label('customer[phone]', 'Phone') }}
				{{ Form::text('customer[phone]') }}
				<span class="error" id="phone"></span>
			</div>
			<div class="detail">
				<button type="button" id="customer-submit" class="button">Save Customer</button>
			</div>
			<script>
			$(document).ready(function(){
				// AJAX Customer submit
				$('#customer-submit').click(function() {
					var formData = {
						first_name: $('#customer\\[first_name\\]').val(),
						last_name: $('#customer\\[last_name\\]').val(),
						email: $('#customer\\[email\\]').val(),
						phone: $('#customer\\[phone\\]').val()
					};
					$.post('{{ route('customers.store') }}', formData, function(data){
						if (data.errors) {
							$.each(data.errors, function(key ,data){
								$('#customer-create').find('#'+key).text(data);
							});
						} else {
							$('#customer-id').val(data.id);
							$('#remove-customer-button').show();
							$('#customer-current').html(
								'<span class="success bold">Customer Successfully Added</span><br>' +
								data.first_name + ' ' + data.last_name + '<br>' +
								data.email + '<br>' + data.phone
							);
							switchSearch();
						};
					},
					'json');
				});
				// Change view button
				$('#hide-search').click(function() {
					switchSearch();
				});
				// Switch search function
				function switchSearch(){
					var search = $('#customer-search');
					var create = $('#customer-create');
					var button = $('#hide-search');
					if (button.data('search')) {
						search.hide();
						create.show();
						button.text('Search For Customer');
						button.data('search', false);
					} else {
						create.hide();
						search.show();
						button.text('Add New Customer');
						button.data('search', true)
					};
				}
			});
			</script>	
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