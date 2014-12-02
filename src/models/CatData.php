<?php

class CatData extends \Eloquent {

    protected $table = 'categories_data';
    protected $fillable = ['name'];


    public function cat()
    {
    	return $this->belongsTo('Cat');
    }
}