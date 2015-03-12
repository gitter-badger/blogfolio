<?php

namespace Ukadev\Blogfolio\Controllers;

use Ukadev\Blogfolio\Controllers\BaseController;
use Settings;
use Language;
use View;
use Config;
use Validator;
use Response;
use Input;


class SettingsController extends BaseController {



	var $rules = array(
	        'site_url' => array('required', 'min:3', 'max:100'),
	        'site_name' => array('required', 'min:3', 'max:100'),
	        'site_email' => array('required', 'min:3', 'max:100')
    	);

	
	/**
	 * Display a listing of the resource.
	 * GET settings
	 *
	 * @return Response
	 */
	public function index()
	{	
		$settings = Settings::all();
		$langs = Language::get();
		$this->layout = View::make('blogfolio::settings.index-settings', compact('settings', 'templates', 'langs'));
        $this->layout->title = trans('blogfolio::settings.settings');
        $this->layout->breadcrumb = Config::get('syntara::breadcrumbs.settings');
	}


	/**
	 * Update the specified resource in storage.
	 * PUT settings
	 *
	 * @return Response
	 */
	public function store()
	{

		 $validator = Validator::make(Input::all(), $this->rules);

		  if($validator->fails())
            {
                return Response::json(array('settingsUpdated' => false, 'errorMessages' => $validator->messages()));
            }



		foreach (Input::all() as $key => $value) {
			Settings::set($key, $value);
		}
		return Response::json(array('settingsUpdated' => true, 'message' => trans('Las opciones se han guardado correctamente'), 'messageType' => 'success'));
	}

}