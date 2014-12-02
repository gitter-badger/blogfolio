<?php

class Cat extends \Eloquent {

    protected $table = 'categories';
    protected $fillable = [];


    public function catData()
    {
        return $this->hasMany('CatData');
    }
}