<?php

class PortfolioSocial extends \Eloquent {

    protected $table = 'portfolios_social';
    protected $fillable = [];


    public function portfolio()
    {
    	return $this->belongsTo('Portfolio');
    }
}