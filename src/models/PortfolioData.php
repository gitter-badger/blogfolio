<?php

class PortfolioData extends \Eloquent {

    protected $table = 'portfolios_data';
    protected $fillable = [];


    public function portfolio()
    {
    	return $this->belongsTo('Portfolio');
    }
}