<?php

function _n( $single, $plural, $var)
{
	if ($var == 1) {
		return $single;
	} else {
		return $plural;
	}
}

Class Format {

	public static function price( $price )
	{
		$currency = '£';
		return $currency . sprintf('%0.2f', $price);
	}
	
	public static function humanTime( $from, $to = '' )
	{
		if ( empty( $to ) )
		$to = time();

		if ($from <= $to) {
			$extra = ' Ago';
		} else {
			$extra = ' Away';
		}

		$diff = (int) abs( $to - $from );

		$MINUTE_IN_SECONDS  = 60;
		$HOUR_IN_SECONDS    = 60 * $MINUTE_IN_SECONDS;
		$DAY_IN_SECONDS     = 24 * $HOUR_IN_SECONDS;
		$WEEK_IN_SECONDS    = 7 * $DAY_IN_SECONDS;
		$YEAR_IN_SECONDS    = 365 * $DAY_IN_SECONDS;

		if ( $diff < $HOUR_IN_SECONDS ) {
			$mins = round( $diff / $MINUTE_IN_SECONDS );
			if ( $mins <= 1 )
				$mins = 1;
			/* translators: min=minute */
			$since = sprintf( _n( '%s min', '%s mins', $mins ), $mins );
		} elseif ( $diff < $DAY_IN_SECONDS && $diff >= $HOUR_IN_SECONDS ) {
			$hours = round( $diff / $HOUR_IN_SECONDS );
			if ( $hours <= 1 )
				$hours = 1;
			$since = sprintf( _n( '%s hour', '%s hours', $hours ), $hours );
		} elseif ( $diff < $WEEK_IN_SECONDS && $diff >= $DAY_IN_SECONDS ) {
			$days = round( $diff / $DAY_IN_SECONDS );
			if ( $days <= 1 )
				$days = 1;
			$since = sprintf( _n( '%s day', '%s days', $days ), $days );
		} elseif ( $diff < 30 * $DAY_IN_SECONDS && $diff >= $WEEK_IN_SECONDS ) {
			$weeks = round( $diff / $WEEK_IN_SECONDS );
			if ( $weeks <= 1 )
				$weeks = 1;
			$since = sprintf( _n( '%s week', '%s weeks', $weeks ), $weeks );
		} elseif ( $diff < $YEAR_IN_SECONDS && $diff >= 30 * $DAY_IN_SECONDS ) {
			$months = round( $diff / ( 30 * $DAY_IN_SECONDS ) );
			if ( $months <= 1 )
				$months = 1;
			$since = sprintf( _n( '%s month', '%s months', $months ), $months );
		} elseif ( $diff >= $YEAR_IN_SECONDS ) {
			$years = round( $diff / $YEAR_IN_SECONDS );
			if ( $years <= 1 )
				$years = 1;
			$since = sprintf( _n( '%s year', '%s years', $years ), $years );
		}

		return $since . $extra;
		}
}