<?php 

namespace Ukadev\Blogfolio\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Routing\Controller;
use Config;
use App;
use Settings;
use Input;
use Sentry;
use Redirect;
use Response;
use Language;
use Portfolio;
use PortfolioProject;
use PortfolioData;
use PortfolioProjectData;
use Project;

class FrontController extends Controller 
{
    

    /*
    * Set current lang
    */
    public function __construct(Language $lang, Portfolio $portfolio, PortfolioProject $project)
    {
        App::setlocale(Settings::get('site_default_lang'));
    }


    /**
    * Setup the layout used by the controller.
    *
    * @return void
    */

    protected function setupLayout()
    {   
        $this->layout = View::make(Config::get('blogfolio::views.frontMaster'));
        $this->layout->title = Settings::get('site_name');
        $this->layout->breadcrumb = array();
    }
}