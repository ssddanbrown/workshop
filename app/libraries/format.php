<?php

Class Format {

	/**
	 * Format prices with decimal and money sign, NOT FOR ACCURATE ROUDNING
	 * @param  Float(2dp) 	$price 
	 * @return String       Formatted price
	 */
	public static function price( $price )
	{
		$currency = '£';
		return $currency . sprintf('%0.2f', $price);
	}

	/**
	 * Date - Format dates for user viewing
	 * @param  Integer $timestamp Timestamp or datetime string
	 * @return String             Formatted date string
	 */
	public static function date( $timestamp = 'now' )
	{
		if( is_int($timestamp) ){
			$timestamp = date_create_from_format('U', strval($timestamp));
		}
		if( !$timestamp instanceof DateTime ){
			$timestamp = date_create($timestamp);
		}
		$format = 'd-m-Y H:i';
		return $timestamp->format($format);
	}

	/**
	 * Date To Database - Change user readable date string to valid database format
	 * @param  String $dateString Input date string in valid format 'd-m-Y H:i'
	 * @return String             Formatted timestamp for database
	 */
	public static function dateToDatabase($dateString)
	{
		$datetime = date_create_from_format('d-m-Y H:i', $dateString);
		if (!$datetime || $datetime < new DateTime('1900-01-01')) { 
			$datetime = date_create('now');
		}
		return $datetime->format('Y-m-d H:i:s');
	}
	
	/**
	 * Human Time - Converts date string/int to readable relative time
	 * @param  Date String/Int $from 
	 * @param  Date String/Int $to   
	 * @return String       Readable time difference
	 */
	public static function humanTime( $from, $to = '' )
	{
		if ( empty( $to ) ) $to = time();

		$from = date_create($from)->getTimestamp();

		if ($from <= $to) {
			$extra = ' ago';
		} else {
			$extra = ' away';
		}

		$diff = (int) abs( $to - $from );

		$MINUTE_IN_SECONDS  = 60;
		$HOUR_IN_SECONDS    = 60 * $MINUTE_IN_SECONDS;
		$DAY_IN_SECONDS     = 24 * $HOUR_IN_SECONDS;
		$WEEK_IN_SECONDS    = 7 * $DAY_IN_SECONDS;
		$YEAR_IN_SECONDS    = 365 * $DAY_IN_SECONDS;

		if ( $diff < $HOUR_IN_SECONDS ) {
			$mins = round( $diff / $MINUTE_IN_SECONDS );
			if ( $mins <= 1 ) $mins = 1;
			$since = sprintf( self::checkPlural( '%s min', '%s mins', $mins ), $mins );
		} elseif ( $diff < $DAY_IN_SECONDS && $diff >= $HOUR_IN_SECONDS ) {
			$hours = round( $diff / $HOUR_IN_SECONDS );
			if ( $hours <= 1 ) $hours = 1;
			$since = sprintf( self::checkPlural( '%s hour', '%s hours', $hours ), $hours );
		} elseif ( $diff < $WEEK_IN_SECONDS && $diff >= $DAY_IN_SECONDS ) {
			$days = round( $diff / $DAY_IN_SECONDS );
			if ( $days <= 1 ) $days = 1;
			$since = sprintf( self::checkPlural( '%s day', '%s days', $days ), $days );
		} elseif ( $diff < 30 * $DAY_IN_SECONDS && $diff >= $WEEK_IN_SECONDS ) {
			$weeks = round( $diff / $WEEK_IN_SECONDS );
			if ( $weeks <= 1 ) $weeks = 1;
			$since = sprintf( self::checkPlural( '%s week', '%s weeks', $weeks ), $weeks );
		} elseif ( $diff < $YEAR_IN_SECONDS && $diff >= 30 * $DAY_IN_SECONDS ) {
			$months = round( $diff / ( 30 * $DAY_IN_SECONDS ) );
			if ( $months <= 1 ) $months = 1;
			$since = sprintf( self::checkPlural( '%s month', '%s months', $months ), $months );
		} elseif ( $diff >= $YEAR_IN_SECONDS ) {
			$years = round( $diff / $YEAR_IN_SECONDS );
			if ( $years <= 1 ) $years = 1;
			$since = sprintf( self::checkPlural( '%s year', '%s years', $years ), $years );
		}

		return $since . $extra;
	}

	static function checkPlural( $single, $plural, $var)
	{
		return $var == 1 ? $single : $plural;
	}

	public static function boolean($boolean)
	{
		return $boolean ? 'Yes' : 'No';
	}

}