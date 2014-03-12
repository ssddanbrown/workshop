<?php


class Note extends Eloquent {

	protected $fillable = ['media', 'text'];

	public function job()
	{
		return $this->belongsTo('Job');
	}

}