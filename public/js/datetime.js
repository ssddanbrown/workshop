
// Auto assign plugin to inputs
$(document).ready(function(){
	$('.datetime').each(function(){
		$(this).datetime();
	});
});

// Main Jquery Function
(function ( $ ) {
	$.fn.datetime = function(){
		// Get date input area and create canvas div
		var dateInput = this; 
		var canvas = $(document.createElement('div'));
		canvas.attr('id', 'datepicker');
		// Append canvas to input
		dateInput.after(canvas);

		// Mouse tracking values
		var hovering = false;
		var focused = false;

		// Names arrays for months and days
		var months = ['January', 'February', 'March', 'April', 'May', 'June',
		'July', 'August', 'September', 'October', 'November', 'December'];
		var days = ['MON', 'TUE', 'WED', 'THUR', 'FRI', 'SAT', 'SUN'];
		
		// Set inital values to track WHAT IS SEEN
		var inputDate = this.val();
		var dateStrings = inputDate.split(/,| |:|-/);
		console.log(dateStrings);
		var month = parseInt(dateStrings[1]) -1;
		var year = parseInt(dateStrings[2]);

		// Set initial values for WHAT DATE IS SELECTED
		var set = function(){};
		set.month = month;
		set.day = parseInt(dateStrings[0]);
		set.year = year;
		set.hour = parseInt(dateStrings[3]);
		set.min = 5 * Math.round(parseInt(dateStrings[4])/5);

		// Function to update the input/user display
		var update = function(){
			if(set.min > 55){
				set.min = 0;
			}
			var formatDay = set.day < 10 ? '0'+set.day : set.day;
			var formatMonth = set.month < 10 ? '0'+(set.month + 1) : (set.month + 1);
			var formatHour = set.hour < 10 ? '0'+set.hour : set.hour;
			var formatMin = set.min < 10 ? '0'+set.min : set.min;
			var dateString = formatDay + '-' + formatMonth + '-' + set.year +
					' ' + formatHour + ':' + formatMin;
			dateInput.val(dateString);
		}

		// Create elements that require global access
		var monthRow = $(document.createElement('div'));
		var monthDisplay = $(document.createElement('span'));
		var datesArea = $(document.createElement('div'));

		// Utility function for repeating strings
		var repeat = function( string, num ){
	    	return new Array( num + 1 ).join( string );
		}


		var setup = function(){
			// Sync input and set value (Rounds to nearest 5 mins)
			update();
			canvas.hide();
			
			// Add Months header
			monthRow.attr('class', 'clear datepicker-monthrow');
			monthRow.append('<button type="button" class="datepicker-prev"><</button>');
			monthRow.append(monthDisplay);
			monthRow.append('<button type="button" class="datepicker-next">></button>');
			canvas.append(monthRow);

			// Add header showing days
			var dayRow = document.createElement('div');
			dayRow.className = 'clear datepicker-days';
			for (var i = 0; i < days.length; i++) {
				dayRow.innerHTML += '<div class="datepicker-date">'+ days[i] +'</div>'
			};
			canvas.append(dayRow);

			datesArea.attr('class', 'datepicker-dates clear');
			canvas.append(datesArea);

			// Add time buttons to widget
			var timeRow = document.createElement('div');
			timeRow.className = 'datepicker-times';
			var times = '';
			times += '<div class="datepicker-header">Hour</div><div class="clear">';
			for( var i = 0; i < 24; i++){
				if (i == set.hour){
					times += '<button type="button" class="datepicker-time-hour current" data-hour="'+i+'" >'+i+'</button>';
				}else{
					times += '<button type="button" class="datepicker-time-hour" data-hour="'+i+'" >'+i+'</button>';
				}
			}
			times += '</div><div class="datepicker-header">Minute</div><div class="clear">';
			for( var i = 0; i<60; i=i+5){
				if (i == set.min){
					times += '<button type="button" class="datepicker-time-min current" data-min="'+i+'" >'+i+'</button>';
				}else{
					times += '<button type="button" class="datepicker-time-min" data-min="'+i+'" >'+i+'</button>';
				}
			}
			times += '</div>';
			timeRow.innerHTML = times;
			canvas.append(timeRow);

			// Show dates for current month
			refreshDates();

			// Show datepicker on input focus
			dateInput.focus(function(){
				canvas.show();
				focused = true;
			});
			dateInput.blur(function(){
				focused = false;
				if( !focused && !hovering) canvas.hide();
			});
			canvas.mouseenter(function(){
				hovering = true;
			});
			// Hide datepicker on unhover of popup
			canvas.mouseleave(function(){
				hovering = false;
				if( !focused && !hovering) canvas.hide();
			});

			// Month & Day Click Events
			canvas.on('click', '.datepicker-next', function(){
				nextMonth();
			});
			canvas.on('click', '.datepicker-prev', function(){
				previousMonth();
			});
			canvas.on('click', 'button.datepicker-date', function(){
				set.year = year;
				set.month = month;
				set.day = $(this).data('day');
				canvas.find('.datepicker-date.current').removeClass('current');
				$(this).addClass('current');
				update();
			});

			// Time Click Events
			canvas.on('click', 'button.datepicker-time-hour', function(){
				set.hour = $(this).data('hour');
				canvas.find('.datepicker-time-hour.current').removeClass('current');
				$(this).addClass('current');
				update();
			});
			canvas.on('click', 'button.datepicker-time-min', function(){
				set.min = $(this).data('min');
				canvas.find('.datepicker-time-min.current').removeClass('current');
				$(this).addClass('current');
				update();
			});
		}
		
		// Finds and sets the next month for the VIEW
		var nextMonth = function(){
			if ( month < 11 ) {
				month ++;
			} else {
				year ++;
				month = 0;
			};
			refreshDates();
		}
		//Finds and sets previous month for the VIEW
		var previousMonth = function(){
			if( month == 0 ){
				year --;
				month = 11;
			} else {
				month--;
			}
			refreshDates();
		}

		// Emptys the calander section and reloads it with the currently set VIEW variables
		var refreshDates = function(){
			monthDisplay.html(months[month] + ' - ' + year);
			datesArea.empty();
			var daysInMonth = new Date(year, month + 1, 0).getDate();
			for(var i = 0; i<daysInMonth; i++){
				// If its the first item pad spaces to make day sit in the correct column
				if(i==0){
					var dayInWeek = new Date(year, month, i+1).getDay();
					if( dayInWeek != 1){
						var diff = 6;
						if( dayInWeek > 1){ diff = dayInWeek - 1; }
						datesArea.html(repeat('<div class="datepicker-date"></div>', diff));
					}
				}
				// Add button and set as selected if it eaquals SET values
				if( set.year == year && set.month == month && set.day == i+1 ){
					datesArea.append('<button type="button" data-day="'+ (i+1) +'" class="datepicker-date current">' + (i+1) +'</button>');
				} else {
					datesArea.append('<button type="button" data-day="'+ (i+1) +'" class="datepicker-date">' + (i+1) +'</button>');
				}
			}
		}
		setup();
		return this;
	}
}( jQuery ));