<?php

class PostData extends \Eloquent {

    protected $table = 'posts_data';
    protected $fillable = [];


    public function post()
    {
    	return $this->belongsTo('Post');
    }
}