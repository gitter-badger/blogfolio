<?php

namespace Ukadev\Blogfolio\Controllers;

use Ukadev\Blogfolio\Controllers\AdminController;
use View;
use Input;
use Language;
use Config;
use Portfolio;
use PortfolioProject;
use PortfolioData;
use PortfolioProjectData;
use Response;
use URL;

class PortfolioController extends AdminController {


	/**
	 * Display a listing of the resource.
	 * GET /admin/portfolios
	 *
	 * @return Response
	 */
	public function indexPortfolios()
	{
		$portfolios = Portfolio::get();

		$langs = Language::where(array('status' => 1))->take(3)->get();
        $this->layout = View::make('blogfolio::portfolio.index',  compact('portfolios', 'langs'));
        $this->layout->title = trans('Portoflios');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.portfolios');
	}


	/**
	 * Display a listing of the resource.
	 * GET /admin/projects
	 *
	 * @return Response
	 */
	public function indexProjects()
	{
		$projects = PortfolioProject::get();

		$langs = Language::where(array('status' => 1))->get();
        $this->layout = View::make('blogfolio::projects.index',  compact('projects', 'langs'));
        $this->layout->title = trans('Projects');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.projects');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /portfolio/new
	 *
	 * @return Response
	 */
	public function newPortfolio()
	{
		$projects = PortfolioProject::where(array('status' => 1))->get();
		$langs = Language::where(array('status' => 1))->get();
		$this->layout = View::make('blogfolio::portfolio.new', compact('langs', 'projects'));
        $this->layout->title = trans('Portoflios');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.portfolios');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /portfolio/project/new
	 *
	 * @return Response
	 */
	public function newProject()
	{
		$langs = Language::where(array('status' => 1))->get();
		$this->layout = View::make('blogfolio::projects.new', compact('langs'));
        $this->layout->title = trans('Projects');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.projects');
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
		$status = (bool) Input::get('status');
		foreach ($all as $key => $value) {
    		if(empty($value)){
    			return Response::json(array('portfolioCreated' => false, 'message' => 'Please, complete the required fields', 'messageType' => 'danger'));
    		}
    	}

		$langs = Language::where(array('status' => 1))->get();
		$portfolio = new Portfolio;
		$portfolio->name = $all['name'];
		$portfolio->status = $status;
		$portfolio->use_skills = $useSkills;

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
    	unset($all['status']);
    	
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
	        	$portfolioData->lang = $lang->locale;
	        	$portfolioData->content = Input::get($lang->locale.'-content');

				$portfolio->portfolioData()->save($portfolioData);
			}

	    	return Response::json(array('portfolioCreated' => true, 'redirectUrl' => URL::route('indexPortfolios')));
	   }else{
	    	return Response::json(array('portfolioCreated' => false, 'message' => 'Error trying to save the current portfolio. Contact the Administrator', 'messageType' => 'danger'));
	    }
	}


	/**
	 * Store a newly created resource in storage.
	 * POST /portfolio/projects/new
	 *
	 * @return Response
	 */
	public function storeProject()
	{	
		$all = Input::all();

		unset($all['file']);
		foreach ($all as $key => $value) {
    		if(empty($value)){
    			return Response::json(array('projectCreated' => false, 'message' => 'Please, complete the required fields', 'messageType' => 'danger'));
    		}
    	}
		$langs = Language::where(array('status' => 1))->get();

		$status = (bool) Input::get('status');
		$project = new PortfolioProject;

		$project->name = $all['name'];
		$project->status = $status;
		$project->image = $all['imageName'];

    	//remove project single values to save projectData
    	unset($all['name']);
    	unset($all['imageName']);
    	unset($all['status']);

    	if($project->save()){
		    foreach ($langs as $lang) {
	        	$projectData = new PortfolioProjectData();
	        	$projectData->project_id = $project->id;
	        	$projectData->lang = $lang->id;
	        	$projectData->content = Input::get($lang->locale.'-content');

				$project->projectData()->save($projectData);
			}
    		return Response::json(array('projectCreated' => true, 'redirectUrl' => URL::route('indexProjects')));
	   }else{
	    	return Response::json(array('projectCreated' => false, 'message' => 'Error trying to save the current portfolio. Contact the Administrator', 'messageType' => 'danger'));
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
		$projects = PortfolioProject::where(array('status' => 1))->get();
		$portfolio = Portfolio::find($id);
		$langs = Language::where(array('status' => 1))->get();
		$allLang = Language::select('id')->where(array('status' => 1))->get();
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
		$this->layout = View::make('blogfolio::portfolio.show', compact('langs', 'allLangs', 'galleries', 'projects', 'portfolio', 'skills'));
        $this->layout->title = trans('Portoflios');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.portfolios');
	}

	/**
	 * Display the specified resource.
	 * GET /portfolio/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showProject($id)
	{
		$project = PortfolioProject::find($id);
		$langs = Language::where(array('status' => 1))->get();
		$allLang = Language::select('id')->where(array('status' => 1))->get();
		foreach ($allLang as $lang) {
			$allLangs[] = $lang->id;
		}

		$this->layout = View::make('blogfolio::projects.show', compact('langs', 'allLangs', 'project'));
        $this->layout->title = trans('Projects');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.projects');
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
		$status = (bool) Input::get('status');
		foreach ($all as $key => $value) {
    		if(empty($value)){
    			return Response::json(array('portfolioUpdated' => false, 'message' => 'Please, complete the required fields', 'messageType' => 'danger'));
    		}
    	}
		$langs = Language::where(array('status' => 1))->get();

		$portfolio = Portfolio::find($id);
		$portfolio->name = $all['name'];
		$portfolio->status = $status;
		$portfolio->use_skills = $useSkills;

		if($useSkills){
    		$skills = array();
    		foreach ($all['skills']['name'] as $key => $value) {
				if(empty($all['skills']['name'][$key]) || empty($all['skills']['percent'][$key])){
	    			return Response::json(array('portfolioUpdated' => false, 'message' => 'Please, complete the required fields', 'messageType' => 'danger'));
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
    	unset($all['status']);

    	if($portfolio->save()){
    		if(PortfolioData::where(array('portfolio_id' => $id))->delete()){
			    foreach ($langs as $lang) {
		        	$portfolioData = new PortfolioData();
		        	$portfolioData->portfolio_id = $portfolio->id;
		        	$portfolioData->lang = $lang->locale;
		        	$portfolioData->content = Input::get($lang->locale.'-content');

					$portfolio->portfolioData()->save($portfolioData);
				}
	    		return Response::json(array('portfolioUpdated' => true, 'redirectUrl' => URL::route('indexPortfolios')));
			}else{
				return Response::json(array('portfolioUpdated' => false, 'message' => 'Error trying to save the current portfolio. Contact the Administrator', 'messageType' => 'danger'));
			}
	   }else{
	    	return Response::json(array('portfolioUpdated' => false, 'message' => 'Error trying to save the current portfolio. Contact the Administrator', 'messageType' => 'danger'));
	    }
	}


	/**
	 * Update the specified resource in storage.
	 * PUT /portfolio/projects/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateProject($id)
	{
		if(!$id){
			return Response::json(array('projectUpdated' => false, 'message' => 'Invalid Project', 'messageType' => 'danger'));
		}

		$all = Input::all();

		unset($all['file']);
		foreach ($all as $key => $value) {
    		if(empty($value)){
    			return Response::json(array('projectUpdated' => false, 'message' => 'Please, complete the required fields', 'messageType' => 'danger'));
    		}
    	}
		$langs = Language::where(array('status' => 1))->get();

		$status = (bool) Input::get('status');
		$project = PortfolioProject::find($id);

		$project->name = $all['name'];
		$project->status = $status;
		$project->image = $all['imageName'];

    	//remove project single values to save projectData
    	unset($all['name']);
    	unset($all['imageName']);
    	unset($all['status']);

    	if($project->save()){
    		if(PortfolioProjectData::where(array('project_id' => $id))->delete()){
			    foreach ($langs as $lang) {
		        	$projectData = new PortfolioProjectData();
		        	$projectData->project_id = $project->id;
		        	$projectData->lang = $lang->locale;
		        	$projectData->content = Input::get($lang->locale.'-content');

					$project->projectData()->save($projectData);
				}
	    		return Response::json(array('projectUpdated' => true, 'redirectUrl' => URL::route('indexProjects')));
			}else{
				return Response::json(array('projectUpdated' => false, 'message' => 'Error trying to save the current portfolio. Contact the Administrator', 'messageType' => 'danger'));
			}
	   }else{
	    	return Response::json(array('projectUpdated' => false, 'message' => 'Error trying to save the current portfolio. Contact the Administrator', 'messageType' => 'danger'));
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
        if(!Portfolio::find($id)->delete())
        {
            return Response::json(array('portfolioDeleted' => false, 'errorMessages' =>'Error al borrar el portfolio', 'messageType' => 'error'));
        }

        return Response::json(array('portfolioDeleted' => true, 'message' => trans('El portfolio se ha borrado correctamente'), 'messageType' => 'success'));
	}


	/**
	 * Remove the specified resource from storage.
	 * DELETE /portfolio/project/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function deleteProject($id)
	{
		if(!$id){
			return Response::json(array('projectDeleted' => false, 'errorMessages' =>'Invalid Project', 'messageType' => 'error'));
		}
        if(!PortfolioProject::find($id)->delete())
        {
            return Response::json(array('projectDeleted' => false, 'errorMessages' =>'Error al borrar el proyecto', 'messageType' => 'error'));
        }

        return Response::json(array('projectDeleted' => true, 'message' => trans('El proyecto se ha borrado correctamente'), 'messageType' => 'success'));
	}


	/**
	 * Upload the specified resource.
	 * POST /portfolio/projects/uploadFile
	 *
	 * @param  int  $id
	 * @return Response
	 */
	function uploadFile(){
        $data = array();
		if(isset($_GET['files']))
		{  
		    $error = false;
		    $files = array();

		    $uploaddir = public_path().'/packages/ukadev/blogfolio/uploads/projects/';
		    foreach($_FILES as $file)
		    {
		        if(move_uploaded_file($file['tmp_name'], $uploaddir .basename(str_replace('/', '-', $file['name']))))
		        {
		            $files[] = $uploaddir .$file['name'];
		        }
		        else
		        {
		            $error = true;
		        }
		    }
		    $data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
		}
		else
		{
		    $data = array('success' => 'Form was submitted', 'formData' => $_POST);
		}

		return Response::json($data);
		
	}
}