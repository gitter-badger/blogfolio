<?php

use MrJuliuss\Syntara\Controllers\BaseController;

class PortfolioController extends \BaseController {


	/**
     * Gallery Model
     * @var gallery
     */
    protected $gallery;

    /**
     * Language Model
     * @var lang
     */
    protected $lang;

    /**
     * Projects Model
     * @var pProject
     */
    protected $project;

    /**
     * Portfolio Model
     * @var portfolio
     */
    protected $portfolio;


	/**
     * Inject the models.
     * @param PortfolioGallery $gallery
     * @param Language $lang
     * @param PortfolioProject $project
     */
    public function __construct(Gallery $gallery, Language $lang, PortfolioProject $project, Portfolio $portfolio)
    {
        $this->gallery = $gallery;
        $this->lang = $lang;
        $this->project = $project;
        $this->portfolio = $portfolio;
    }


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
        $this->layout = View::make('blogfolio::portfolio.index',  compact('portfolios', 'langs'));
        $this->layout->title = trans('Portoflios');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.portfolios');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /portfolio/create
	 *
	 * @return Response
	 */
	public function newPortfolio()
	{
		$lang = new Language();
		$projects = $this->project->where(array('active' => 1))->get();
		$langs = $lang->where(array('active' => 1))->get();
		$galleries = $this->gallery->where(array('active' => 1))->get();
		$this->layout = View::make('blogfolio::portfolio.new', compact('langs', 'galleries', 'projects'));
        $this->layout->title = trans('Portoflios');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.portfolios');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /portfolio
	 *
	 * @return Response
	 */
	public function storePortfolio()
	{	
		$socials = array();
		$all = Input::all();
		$useSkills = (bool) Input::get('user_skills');
		$social = Input::get('social');
		$active = (bool) Input::get('active');
		foreach ($all as $key => $value) {
    		if(empty($value)){
    			return Response::json(array('portfolioCreated' => false, 'message' => 'Please, complete the required fields', 'messageType' => 'danger'));
    		}
    	}

		$langs = $this->lang->where(array('active' => 1))->get();
		$portfolio = $this->portfolio;
		$portfolio->name = $all['name'];
		$portfolio->status = $active;
		$portfolio->use_skills = $useSkills;
		$portfolio->gallery_id = Input::get('gallery');

    	if(isset($all['projects'])){
    		$projects = array();
    		foreach ($all['projects'] as $value) {
				array_push($projects, $value);
			}
    		$projects = implode(',', $projects);
			$portfolio->projects = $projects;
    	}
    	//remove portfolio single values to save portfolioData
    	unset($all['name']);
    	unset($all['portfolios']);
    	unset($all['active']);
    	unset($all['gallery']);
    	
    	if($portfolio->save()){
    		
    		foreach ($social as $key => $value) {
	    		if (!empty($value['url'])) {
	    			$portfolioSocial = new PortfolioSocial();
	    			$portfolioSocial->name = strtolower($social['name'][$key]);
	    			$portfolioSocial->url = $social['url'][$key];
	    			$portfolioSocial->portfolio_id = $portfolio->id;
	    			$portfolio->portfolioSocial()->save($portfolioSocial);
	    		}
	    	}

	    	if($useSkills){
	    		$skills = array();
	    		foreach ($all['skills']['name'] as $key => $value) {
					if(empty($all['skills']['name'][$key]) || empty($all['skills']['percent'][$key])){
		    			return Response::json(array('portfolioCreated' => false, 'message' => 'Please, complete the required fields', 'messageType' => 'danger'));
		    		}
					array_push($skills, $all['skills']['name'][$key].':'.$all['skills']['percent'][$key]);
				}
	    		$skills = implode(',', $skills);
				$portfolio->skills = $skills;
	    	}

		    foreach ($langs as $lang) {
	        	$portfolioData = new PortfolioData();
	        	$portfolioData->portfolio_id = $portfolio->id;
	        	$portfolioData->lang_id = $lang->id;
	        	$portfolioData->content = Input::get($lang->locale.'-content');

				$portfolio->portfolioData()->save($portfolioData);
			}

	    	return Response::json(array('portfolioCreated' => true, 'redirectUrl' => URL::route('indexPortfolios')));
	   }else{
	    	return Response::json(array('portfolioCreated' => false, 'message' => 'Error trying to save the current portfolio. Contact the Administrator', 'messageType' => 'danger'));
	    }
	}

	/**
	 * Display the specified resource.
	 * GET /portfolio/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showPortfolio($id)
	{
		$skills = array();
		$social = array();
		$lang = new Language();
		$projects = $this->project->where(array('active' => 1))->get();
		$portfolio = $this->portfolio->find($id);
		$langs = $lang->where(array('active' => 1))->get();
		$allLang = $this->lang->select('id')->where(array('active' => 1))->get();
		foreach ($allLang as $lang) {
			$allLangs[] = $lang->id;
		}

		if($portfolio->skills){
			$skill = explode(',', $portfolio->skills);
			foreach ($skill as $key => $value) {
				$s = explode(':', $value);
				$skills[$key]['name'] = $s[0];
				$skills[$key]['percent'] = $s[1];

			}
		}else{
			$portfolio->use_skills = 0;
		}

		$portfolio->projects = explode(',', $portfolio->projects);
		$galleries = $this->gallery->where(array('active' => 1))->get();
		$this->layout = View::make('blogfolio::portfolio.show', compact('langs', 'allLangs', 'galleries', 'projects', 'portfolio', 'skills'));
        $this->layout->title = trans('Portoflios');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.portfolios');
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /portfolio/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updatePortfolio($id)
	{
		if(!$id){
			return Response::json(array('portfolioUpdated' => false, 'message' => 'Invalid Portfolio', 'messageType' => 'danger'));
		}

		$all = Input::all();

		$useSkills = (bool) Input::get('user_skills');
		$active = (bool) Input::get('active');
		foreach ($all as $key => $value) {
    		if(empty($value)){
    			return Response::json(array('portfolioCreated' => false, 'message' => 'Please, complete the required fields', 'messageType' => 'danger'));
    		}
    	}
		$langs = $this->lang->where(array('active' => 1))->get();

		$portfolio = Portfolio::find($id);
		$portfolio->name = $all['name'];
		$portfolio->status = $active;
		$portfolio->use_skills = $useSkills;
		$portfolio->gallery_id = Input::get('gallery');

		if($useSkills){
    		$skills = array();
    		foreach ($all['skills']['name'] as $key => $value) {
				if(empty($all['skills']['name'][$key]) || empty($all['skills']['percent'][$key])){
	    			return Response::json(array('portfolioCreated' => false, 'message' => 'Please, complete the required fields', 'messageType' => 'danger'));
	    		}
				array_push($skills, $all['skills']['name'][$key].':'.$all['skills']['percent'][$key]);
			}
    		$skills = implode(',', $skills);
			$portfolio->skills = $skills;
    	}
    	if(isset($all['projects'])){
    		$projects = array();
    		foreach ($all['projects'] as $value) {
				array_push($projects, $value);
			}
    		$projects = implode(',', $projects);
			$portfolio->projects = $projects;
    	}
    	//remove portfolio single values to save portfolioData
    	unset($all['name']);
    	unset($all['portfolios']);
    	unset($all['active']);
    	unset($all['gallery']);

    	if($portfolio->save()){
    		if(PortfolioData::where(array('portfolio_id' => $id))->delete()){
			    foreach ($langs as $lang) {
		        	$portfolioData = new PortfolioData();
		        	$portfolioData->portfolio_id = $portfolio->id;
		        	$portfolioData->lang_id = $lang->id;
		        	$portfolioData->content = Input::get($lang->locale.'-content');

					$portfolio->portfolioData()->save($portfolioData);
				}
	    		return Response::json(array('portfolioCreated' => true, 'redirectUrl' => URL::route('indexPortfolios')));
			}else{
				return Response::json(array('portfolioCreated' => false, 'message' => 'Error trying to save the current portfolio. Contact the Administrator', 'messageType' => 'danger'));
			}
	   }else{
	    	return Response::json(array('portfolioCreated' => false, 'message' => 'Error trying to save the current portfolio. Contact the Administrator', 'messageType' => 'danger'));
	    }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /portfolio/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function deletePortfolio($id)
	{
		if(!$id){
			return Response::json(array('portfolioDeleted' => false, 'errorMessages' =>'Invalid Portfolio', 'messageType' => 'error'));
		}
        if(!$this->portfolio->find($id)->delete())
        {
            return Response::json(array('portfolioDeleted' => false, 'errorMessages' =>'Error al borrar el portfolio', 'messageType' => 'error'));
        }

        return Response::json(array('portfolioDeleted' => true, 'message' => trans('El portfolio se ha borrado correctamente'), 'messageType' => 'success'));
	}

}