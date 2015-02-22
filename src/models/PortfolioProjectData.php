<?php

class PortfolioProjectData extends \Eloquent {

    protected $table = 'portfolios_project_data';
    protected $fillable = [];


    public function project()
    {
    	return $this->belongsTo('Project');
    }
}