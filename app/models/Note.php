<?php


class Note extends Eloquent {

	protected $fillable = ['media', 'text', 'job_id'];

	public function job()
	{
		return $this->belongsTo('Job');
	}


}