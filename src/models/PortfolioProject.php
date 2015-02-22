<?php

class PortfolioProject extends \Eloquent {
	
	protected $table = 'portfolios_project';
	protected $fillable = [];

	/**
	 * Get the portfolio's data.
	 *
	 * @return User
	 */
	public function projectData()
	{
		return $this->hasMany('PortfolioProjectData', 'project_id');
	}
}