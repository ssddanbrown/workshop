<?php


class Note extends Eloquent {

	protected $fillable = [];

	public function job()
	{
		return $this->belongsTo('Job');
	}

}