<?php

Form::macro('delete', function($route, $text = 'Delete', $route_var, $classes = 'inline'){

	return Form::open( array(
		'method' => 'DELETE',
		'route' => array($route, $route_var),
		'class' => $classes
		) )
		. Form::submit($text, array('class'=>'button'))
		. Form::close();
});

Form::macro('toggleFinished', function($job, $text = ['Done', 'Not Done'], $classes = 'inline'){

	if ( $job->finished ) {
		$button_text = $text[1];
	} else {
		$button_text = $text[0];
	}

	return Form::open( array(
		'method' => 'POST',
		'route' => array('jobs.toggle', $job->id),
		'class' => $classes
		) )
		.Form::submit($button_text, array('class'=>'button'))
		.Form::close();
});