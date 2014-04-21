@extends('common.main')

@section('content')
	
<div id="datepicker">
</div>

<script>
$(document).ready(function(){

	function dateTimePicker(target){

		this.canvas = target;

		this.months = ['January', 'February', 'March', 'April', 'May', 'June',
		'July', 'August', 'September', 'October', 'November', 'December'];
		this.days = ['SUN', 'MON', 'TUE', 'WED', 'THUR', 'FRI', 'SAT'];
		this.date = new Date(); // Change to get from input
		this.month = this.date.getMonth();
		this.year = this.date.getFullYear();

		this.set = function(){};
		this.set.month = 3;
		this.set.day = 20;
		this.set.year = 2014;

		this.monthRow = $(document.createElement('div'));
		this.monthDisplay = $(document.createElement('span'));
		this.datesArea = $(document.createElement('div'));

		this.repeat = function( string, num ){
	    	return new Array( num + 1 ).join( string );
		}

		this.getSetDate = function(){
			return new Date(this.set.year, this.set.month, this.set.day);
		}

		this.setup = function(){
			var context = this;
			this.monthRow.attr('class', 'clear datepicker-monthrow');
			this.monthRow.append('<button type="button" class="datepicker-prev"><</button>');
			this.monthRow.append(context.monthDisplay);
			this.monthRow.append('<button type="button" class="datepicker-next">></button>');
			this.canvas.append(context.monthRow);
			var dayRow = document.createElement('div');
			dayRow.className = 'clear';
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

			// Show dates for current month
			this.refreshDates();

			// Click Events
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
				context.canvas.find('.current').removeClass('current');
				$(this).addClass('current');
			});
		}

		this.nextMonth = function(){
			if ( this.month < 11 ) {
				this.month ++;
			} else {
				this.year ++;
				this.month = 0;
			};
			this.refreshDates();
		}
		this.previousMonth = function(){
			if( this.month == 0 ){
				this.year --;
				this.month = 11;
			} else {
				this.month--;
			}
			this.refreshDates();
		}

		this.refreshDates = function(){
			var context = this;
			this.monthDisplay.html(context.months[context.month] + ' - ' + context.year);
			this.datesArea.empty();
			var daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
			for(var i = 0; i<daysInMonth; i++){
				if(i==0){
					var dayInWeek = new Date(this.year, this.month, i+1).getDay();
					if( dayInWeek != 1){
						var diff = 6;
						if( dayInWeek > 1){ diff = dayInWeek - 1; }
						this.datesArea.html(this.repeat('<div class="datepicker-date"></div>', diff));
					}
				}
				if( this.set.year == this.year && this.set.month == this.month && this.set.day == i+1 ){
					this.datesArea.append('<button type="button" data-day="'+ (i+1) +'" class="datepicker-date current">' + (i+1) +'</button>');
				} else {
					this.datesArea.append('<button type="button" data-day="'+ (i+1) +'" class="datepicker-date">' + (i+1) +'</button>');
				}
			}
		}


	}

	var instance = new dateTimePicker( $('#datepicker') );
	instance.setup();

});
</script>


@stop

