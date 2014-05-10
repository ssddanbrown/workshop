@extends('common.main')

@section('content')

<input type="text" class="testinput" value="{{ date('Y-m-d H:i:s' ,strtotime('now')) }}">

<script>
$(document).ready(function(){

	function dateTimePicker(dateInput){

		// Get date input area and create canvas div
		this.dateInput = dateInput; 
		this.canvas = $(document.createElement('div'));
		this.canvas.attr('id', 'datepicker');
		// Append canvas to input
		dateInput.after(this.canvas);

		// Mouse tracking values
		this.hovering = false;
		this.focused = false;

		// Names arrays for months and days
		this.months = ['January', 'February', 'March', 'April', 'May', 'June',
		'July', 'August', 'September', 'October', 'November', 'December'];
		this.days = ['SUN', 'MON', 'TUE', 'WED', 'THUR', 'FRI', 'SAT'];
		
		// Set inital values to track WHAT IS SEEN
		this.inputDate = dateInput.val();
		this.date = new Date(); // Change to get from input
		this.month = this.date.getMonth();
		this.year = this.date.getFullYear();

		// Set initial values for WHAT DATE IS SELECTED
		this.set = function(){};
		this.set.month = this.month;
		this.set.day = this.date.getDay();
		this.set.year = this.year;
		this.set.hour =this.date.getHours();
		this.set.min = 5 * Math.round(this.date.getMinutes()/5);

		// Function to update the input/user display
		this.update = function(){
			if(this.set.min > 55){
				this.set.min = 0;
			}
			var formatDay = this.set.day < 10 ? '0'+this.set.day : this.set.day;
			var formatMonth = this.set.month < 10 ? '0'+(this.set.month+1) : (this.set.month+1);
			var formatHour = this.set.hour < 10 ? '0'+this.set.hour : this.set.hour;
			var formatMin = this.set.min < 10 ? '0'+this.set.min : this.set.min;
			var dateString = formatDay + '-' + formatMonth + '-' + this.set.year +
					' ' + formatHour + ':' + formatMin;
			this.dateInput.val(dateString);
		}

		// Create elements that require global access
		this.monthRow = $(document.createElement('div'));
		this.monthDisplay = $(document.createElement('span'));
		this.datesArea = $(document.createElement('div'));

		// Utility function for repeating strings
		this.repeat = function( string, num ){
	    	return new Array( num + 1 ).join( string );
		}

		this.setup = function(){
			var context = this;
			// Sync input and set value (Rounds to nearest 5 mins)
			context.update();
			this.canvas.hide();
			
			// Add Months header
			this.monthRow.attr('class', 'clear datepicker-monthrow');
			this.monthRow.append('<button type="button" class="datepicker-prev"><</button>');
			this.monthRow.append(context.monthDisplay);
			this.monthRow.append('<button type="button" class="datepicker-next">></button>');
			this.canvas.append(context.monthRow);

			// Add header showing days
			var dayRow = document.createElement('div');
			dayRow.className = 'clear datepicker-days';
			dayRow.innerHTML = '<div class="datepicker-date">MON</div>'
				+	'<div class="datepicker-date">TUE</div>'
				+	'<div class="datepicker-date">WED</div>'
				+	'<div class="datepicker-date">THUR</div>'
				+	'<div class="datepicker-date">FRI</div>'
				+	'<div class="datepicker-date">SAT</div>'
				+	'<div class="datepicker-date">SUN</div>';
			this.canvas.append(dayRow);

			this.datesArea.attr('class', 'datepicker-dates clear');
			this.canvas.append(this.datesArea);

			// Add time buttons to widget
			var timeRow = document.createElement('div');
			timeRow.className = 'datepicker-times';
			var times = '';
			times += '<div class="datepicker-header">Hour</div><div class="clear">';
			for( var i = 0; i < 24; i++){
				if (i == this.set.hour){
					times += '<button type="button" class="datepicker-time-hour current" data-hour="'+i+'" >'+i+'</button>';
				}else{
					times += '<button type="button" class="datepicker-time-hour" data-hour="'+i+'" >'+i+'</button>';
				}
			}
			times += '</div><div class="datepicker-header">Minute</div><div class="clear">';
			for( var i = 0; i<60; i=i+5){
				if (i == this.set.min){
					times += '<button type="button" class="datepicker-time-min current" data-min="'+i+'" >'+i+'</button>';
				}else{
					times += '<button type="button" class="datepicker-time-min" data-min="'+i+'" >'+i+'</button>';
				}
			}
			times += '</div>';
			timeRow.innerHTML = times;
			this.canvas.append(timeRow);

			// Show dates for current month
			this.refreshDates();

			// Show datepicker on input focus
			this.dateInput.focus(function(){
				context.canvas.show();
				context.focused = true;
			});
			this.dateInput.blur(function(){
				context.focused = false;
				if( !context.focused && !context.hovering) context.canvas.hide();
			});
			this.canvas.mouseenter(function(){
				context.hovering = true;
			});
			// Hide datepicker on unhover of popup
			this.canvas.mouseleave(function(){
				context.hovering = false;
				if( !context.focused && !context.hovering) context.canvas.hide();
			});

			// Month & Day Click Events
			this.canvas.on('click', '.datepicker-next', function(){
				context.nextMonth();
			});
			this.canvas.on('click', '.datepicker-prev', function(){
				context.previousMonth();
			});
			this.canvas.on('click', 'button.datepicker-date', function(){
				context.set.year = context.year;
				context.set.month = context.month;
				context.set.day = $(this).data('day');
				context.canvas.find('.datepicker-date.current').removeClass('current');
				$(this).addClass('current');
				context.update();
			});

			// Time Click Events
			this.canvas.on('click', 'button.datepicker-time-hour', function(){
				context.set.hour = $(this).data('hour');
				context.canvas.find('.datepicker-time-hour.current').removeClass('current');
				$(this).addClass('current');
				context.update();
			});
			this.canvas.on('click', 'button.datepicker-time-min', function(){
				context.set.min = $(this).data('min');
				context.canvas.find('.datepicker-time-min.current').removeClass('current');
				$(this).addClass('current');
				context.update();
			});
		}
		
		// Finds and sets the next month for the VIEW
		this.nextMonth = function(){
			if ( this.month < 11 ) {
				this.month ++;
			} else {
				this.year ++;
				this.month = 0;
			};
			this.refreshDates();
		}
		//Finds and sets previous month for the VIEW
		this.previousMonth = function(){
			if( this.month == 0 ){
				this.year --;
				this.month = 11;
			} else {
				this.month--;
			}
			this.refreshDates();
		}

		// Emptys the calander section and reloads it with the currently set VIEW variables
		this.refreshDates = function(){
			var context = this;
			this.monthDisplay.html(context.months[context.month] + ' - ' + context.year);
			this.datesArea.empty();
			var daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
			for(var i = 0; i<daysInMonth; i++){
				// If its the first item pad spaces to make day sit in the correct column
				if(i==0){
					var dayInWeek = new Date(this.year, this.month, i+1).getDay();
					if( dayInWeek != 1){
						var diff = 6;
						if( dayInWeek > 1){ diff = dayInWeek - 1; }
						this.datesArea.html(this.repeat('<div class="datepicker-date"></div>', diff));
					}
				}
				// Add button and set as selected if it eaquals SET values
				if( this.set.year == this.year && this.set.month == this.month && this.set.day == i+1 ){
					this.datesArea.append('<button type="button" data-day="'+ (i+1) +'" class="datepicker-date current">' + (i+1) +'</button>');
				} else {
					this.datesArea.append('<button type="button" data-day="'+ (i+1) +'" class="datepicker-date">' + (i+1) +'</button>');
				}
			}
		}

	}

	var instance = new dateTimePicker( $('.testinput') );
	instance.setup();

});
</script>


@stop

