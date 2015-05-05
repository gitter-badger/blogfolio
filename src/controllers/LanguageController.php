<?php

namespace Ukadev\Blogfolio\Controllers;

use Ukadev\Blogfolio\Controllers\AdminController;
use Config;
use Input;
use Response;
use Request;
use URL;
use Language;
use View;
use App;

class LanguageController extends AdminController 
{

	/**
	 * Display a listing of the resource.
	 * GET settings
	 *
	 * @return Response
	 */
	public function index()
	{	
		$languages = Language::get();
		$this->layout = View::make('blogfolio::language.index', compact('languages'));
        $this->layout->title = trans('blogfolio::language.languages');
        $this->layout->breadcrumb = Config::get('blogfolio::breadcrumbs.languages');
	}


	/**
	 * Show the form for creating a new resource.
	 * GET /admin/blog/category/new
	 *
	 * @return Response
	 */
	public function newLanguage()
	{
        $this->layout = View::make('blogfolio::language.new');
        $this->layout->title = trans('blogfolio::language.languages');
        $this->layout->breadcrumb = Config::get('blogfolio::breadcrumbs.languages');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /admin/blog/categories/s{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showLanguage($id)
	{
		$lang = Language::find($id);
		$this->layout = View::make('blogfolio::language.show', compact('lang'));
        $this->layout->title = trans('blogfolio::language.languages');
        $this->layout->breadcrumb = Config::get('blogfolio::breadcrumbs.languages');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /admin/language/new
	 *
	 * @return Response
	 */
	public function storeLanguage()
	{
        $all = Input::all();
        foreach ($all as $key => $value) {
        	if(empty($value)){
    			return Response::json(array('languageCreated' => false, 'message' => 'Please, complete the required fields', 'messageType' => 'danger'));
    		}
        }
        $language = new Language();
        $language->name = Input::get('name');
        $language->status = (bool)Input::get('status');
        $language->locale = Input::get('locale');

        $language->save();

        return Response::json(array('languageCreated' => true, 'redirectUrl' => URL::route('indexLanguages')));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /admin/blog/categories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateLanguage($id)
	{	
		$name = Input::get('name');
		$locale = Input::get('locale');
		$status = (bool)Input::get('status');
        Language::where(array('id' => $id))->update(array('name' => $name, 'locale' => $locale, 'status' => $status));

        return Response::json(array('languageUpdated' => true, 'redirectUrl' => URL::route('indexLanguages')));
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /admin/blog/categories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function deleteLanguage($id)
	{
		if(!$id){
			return Response::json(array('languageDeleted' => false, 'errorMessages' =>'Invalid language', 'messageType' => 'error'));
		}
        if(!Language::find($id)->delete())
        {
            return Response::json(array('languageDeleted' => false, 'errorMessages' =>'Error al borrar el lenguaje', 'messageType' => 'error'));
        }

        return Response::json(array('languageDeleted' => true, 'message' => trans('El lenguaje se ha borrado correctamente'), 'messageType' => 'success'));
	}

}