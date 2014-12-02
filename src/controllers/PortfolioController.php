<?php

class PortfolioController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /admin/categories
	 *
	 * @return Response
	 */
	public function indexPortfolios()
	{

		$portfolios = Portfolio::get();
		$lang = new Language();
		$langs = $lang->where(array('active' => 1))->take(3)->get();
        $this->layout = View::make('admin.portfolio.index', compact('portfolios', 'langs'));
        $this->layout->title = trans('Portoflios');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.portfolios');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /portfolio/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /portfolio
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /portfolio/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /portfolio/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /portfolio/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /portfolio/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}