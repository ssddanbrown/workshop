<script>
var addForm = function(type){
	var container = ""; var inner = ""; var biggestIndex = 0;

	if (type == 'cost') {
		container = document.getElementById('cost-container');
	} else if(type == 'item'){
		container = document.getElementById('item-container');
	}

	var containerChildren = container.children;
	for (var i = 0; i < containerChildren.length; i++) {
		var index = containerChildren[i].getAttribute('data-index');
		index = parseInt(index, 10);
		if (index >= biggestIndex) { biggestIndex = index + 1;};
	};
	var element = document.createElement('tr');
	element.className = 'table-row';
	element.dataset.index = biggestIndex;

	if (type=='cost') {
		inner = '<td><input type="text" name="costs['+ biggestIndex +'][cost_qty]" /></td>';
		inner += '<td><input type="text" name="costs['+ biggestIndex +'][cost_text]" /></td>';
		inner += '<td><input type="text" name="costs['+ biggestIndex +'][cost_price]" /></td>';
		inner += '<td><input type="text" name="costs['+ biggestIndex +'][discount]" /></td>';
		inner += '<td><button type="button" class="delete-row">X</button></td>';
		container = document.getElementById('cost-container');
	} else if(type=='item'){
		inner = '<td><input type="text" name="items['+ biggestIndex +'][item_title]" /></td>';
		inner += '<td><input type="text" name="items['+ biggestIndex +'][item_text]" /></td>';
		inner += '<td><button type="button" class="delete-row">X</button></td>';
	}

	element.innerHTML = inner;
	container.appendChild(element);
}
$(document).ready(function(){

	$('table').on('click', '.delete-row', function(){
		var row = $(this).parent().parent()
		row.find('input').val('');
		if( row.parent().find('.table-row:visible').length > 1 ){
			row.hide();
		}
		
	});

});
</script>