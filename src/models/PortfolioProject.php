<?php

class PortfolioProject extends \Eloquent {

    protected $table = 'portfolios_project';
    protected $fillable = [];


    public function portfolio()
    {
    	return $this->belongsTo('Portfolio');
    }
}