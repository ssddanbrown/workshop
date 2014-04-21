@extends('common.main')

@section('content')
	
<div id="datepicker">
	<div class="datepicker-date"></div>
</div>
<script>
$(document).ready(function(){

	function repeat( string, num ){
	    return new Array( num + 1 ).join( string );
	}

	var canvas = $('#datepicker');
	var months = ['January', 'February', 'March', 'April', 'May', 'June',
		'July', 'August', 'September', 'October', 'November', 'December'];
	var days = ['SUN', 'MON', 'TUE', 'WED', 'THUR', 'FRI', 'SAT'];
	var date = new Date();
	var month = date.getMonth();
	var year = date.getFullYear();

	var html = '<div class="clear">';
	html += '<div class="datepicker-date">MON</div>';
	html += '<div class="datepicker-date">TUE</div>';
	html += '<div class="datepicker-date">WED</div>';
	html += '<div class="datepicker-date">THUR</div>';
	html += '<div class="datepicker-date">FRI</div>';
	html += '<div class="datepicker-date">SAT</div>';
	html += '<div class="datepicker-date">SUN</div>';
	html += '</div>';

	var daysInMonth = new Date(year, month+1, 0).getDate();

	html += '<div id="datepicker-dates">';
	for(var i=0; i<daysInMonth; i++){
		if(i==0){
			var dayInWeek = new Date(year, month+1, i).getDay();
			if( dayInWeek != 1){
				var diff = 6;
				if( dayInWeek > 1){ diff = dayInWeek - 1; }
				html += repeat('<div class="datepicker-date"></div>', diff);
			}
		}
		html += '<div class="datepicker-date">' + (i+1) +'</div>';
	}
	html += '</div>';

	canvas.html(html);
});
</script>


@stop

