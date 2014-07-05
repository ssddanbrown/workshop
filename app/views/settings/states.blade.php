@extends('common.main')

@section('content')
{{ Form::open(array('route' => 'settings.states.save')) }}


	<div class="header">
		<h1>{{ link_to_route('settings.index', 'Settings')}} / Job Statuses</h1>
		<div class="buttons">
			<button id="add-status" type="button">Add Status</button>
			{{ Form::submit('Save Statuses', array('class' => 'button pos')) }}
		</div>
	</div>

	<table class="table-grid">
		<thead>
			<tr>
				<th>Name</th>
				<th>Jobs Assigned</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody class="sortable">
			@foreach($states as $state)
			<tr>
				{{ Form::hidden("state[{$state->id}][id]", $state->id, array('class'=>'hook-id')) }}
				{{ Form::hidden("state[{$state->id}][value]", $state->value, array('class'=>'hook-value')) }}
				<td>{{ Form::text("state[{$state->id}][name]", $state->name, array('class'=>'hook-name')) }}</td>
				<td class="hook-count">{{ $state->jobCount() }}</td>
				<td>
					<button type="button" class="hook-up">Move Up</button>
					<button type="button" class="hook-down">Move Down</button>
					{{ link_to_route('settings.states.delete.confirmation','Delete', $state->id, array('class'=>'button neg hook-delete')) }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>


{{ Form::close() }}
<script>
$(document).ready(function(){

	$('#add-status').click(function(){

		// Create new id unique id for input fields
		var newID = 0;
		$('.hook-id').each(function(){
			var id = parseInt($(this).val());
			if (id > newID) {
				newID = id;
			};
		});
		newID++;
		// Get last row in table and use as model for new row
		var lastRow = $('table tbody tr').last();
		var newRow = lastRow.clone();
		newRow.find('input.hook-id').val(newID);
		newRow.find('input.hook-name').val('New Status');
		newRow.find('.hook-count').text('0');
		newRow.find('.hook-delete').replaceWith('<button type="button" class="button neg hook-delete" >Delete</button>');
		newRow.find('input').each(function(){
			var oldName = $(this).attr('name');
			$(this).attr('name', oldName.replace(/state\[.*?\]/g, 'state['+newID+']'));
		});

		// Add new row to dom and set order
		lastRow.after(newRow);
		setOrder();

	}); // End add status click

	// Deleting a new row
	$('.sortable').on('click', 'button.hook-delete', function(){
		$(this).closest('tr').remove();
		setOrder();
	});

	// Row sorting
	$('.sortable').on('click', '.hook-up', function(){
		var row = $(this).closest('tr');
		row.prev().before(row);
		setOrder();
	});
	$('.sortable').on('click', '.hook-down', function(){
		var row = $(this).closest('tr');
		row.next().after(row);
		setOrder();
	});
	// Set order (value input) of each row
	var setOrder = function() {
		$('.sortable tr').each(function(index){
			$(this).find('input.hook-value').val(index);
		});
	};


});
</script>
@stop