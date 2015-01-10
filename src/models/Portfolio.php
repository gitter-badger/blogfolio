<?php

class Portfolio extends \Eloquent {
	
	protected $table = 'portfolios';
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

	/**
	 * Get the portfolio's social links.
	 *
	 * @return User
	 */
	public function portfolioSocial()
	{
		return $this->hasMany('PortfolioSocial', 'portfolio_id');
	}
}