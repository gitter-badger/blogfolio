<?php

class Portfolio extends \Eloquent {
	protected $fillable = [];

	/**
	 * Get the portfolio's data.
	 *
	 * @return User
	 */
	public function portfolioData()
	{
		return $this->hasMany('PortfolioData', 'portfolio_id');
	}
}