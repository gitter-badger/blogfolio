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
	
	/**
    * About page
    */
    public function getAbout()
    {
        $this->layout = View::make('blogfolio::front.about');
        $this->layout->settings = Settings::all();
        $this->layout->socialLinks = (!empty(Settings::get('site_social_links'))) ? json_decode(Settings::get('site_social_links')) : '';
    }

    /**
    * Contact page
    */
    public function getContact()
    {
        $this->layout = View::make('blogfolio::front.contact');
        $this->layout->settings = Settings::all();
        $this->layout->socialLinks = (!empty(Settings::get('site_social_links'))) ? json_decode(Settings::get('site_social_links')) : '';
    }

    /**
    * Blog page
    */
    public function getBlog()
    {
        $this->layout = View::make('blogfolio::front.blog');
        $this->layout->settings = Settings::all();
        $this->layout->socialLinks = (!empty(Settings::get('site_social_links'))) ? json_decode(Settings::get('site_social_links')) : '';
    }
    
    /**
    * Blog Item page
    */
    public function getBlogItem()
    {   
        $secret_key = Settigs::get('site_disqus_key');
        $disqus = new DisqusAPI($secret_key);
        // to turn off SSL
        $disqus->setSecure(false);
        // call the API
        $disqus->trends->listThreads();

        $this->layout = View::make('blogfolio::front.blog-item');
        $this->layout->settings = Settings::all();
        $this->layout->socialLinks = (!empty(Settings::get('site_social_links'))) ? json_decode(Settings::get('site_social_links')) : '';
    }

    /**
    * Portfolio page
    */
    public function getPortfolio()
    {
        $this->layout = View::make('blogfolio::front.portfolio');
        $this->layout->settings = Settings::all();
        $this->layout->socialLinks = (!empty(Settings::get('site_social_links'))) ? json_decode(Settings::get('site_social_links')) : '';
    }


}