<?php

namespace Ukadev\Blogfolio\Controllers;

use Ukadev\Blogfolio\Controllers\FrontController;
use View;
use Input;
use Redirect;
use Config;
use Response;
use Settings;

class FrontendController extends FrontController
{
    /**
    * Index page
    */
    public function getIndex()
    {
        $this->layout = View::make('blogfolio::front.index');
        $this->layout->settings = Settings::all();
        $this->layout->socialLinks = (!empty(Settings::get('site_social_links'))) ? json_decode(Settings::get('site_social_links')) : '';
    }
}