<script>
$(document).ready(function(){

	function addForm(container){
		var biggestIndex = 0;
		var model = container.find('.model').first();

		var containerChildren = container.children('.table-row');
		containerChildren.each(function(){
			var index = $(this).data('index');
			index = parseInt(index);
			if(index >= biggestIndex) biggestIndex = index+1;
		});
		var newRow = model.clone().removeAttr('style');
		newRow.attr('data-index', biggestIndex);

		newRow.find('input').each(function(){
			var name = $(this).attr('name');
			$(this).attr( 'name', name.replace('[-1]', '['+biggestIndex+']') );
		});

		container.append(newRow);
	}

	$('#button-add-item').click(function(){
		addForm( $('#item-container') );
	});
	$('#button-add-cost').click(function(){
		addForm( $('#cost-container') );
	});

	$('table').on('click', '.delete-row', function(){
		var row = $(this).parent().parent();
		row.find('input').val('');
		if( row.parent().find('.table-row:visible').length > 1 ){
			row.remove();
		}
	});


});
</script>