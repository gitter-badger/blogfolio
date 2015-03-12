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

class BaseController extends Controller 
{
    

    /*
    * Set current lang
    */
    public function __construct(Language $lang, Portfolio $portfolio, PortfolioProject $project)
    {
        App::setlocale(Settings::get('site_admin_lang'));
    }


    /**
    * Setup the layout used by the controller.
    *
    * @return void
    */

    protected function setupLayout()
    {
        $this->layout = View::make(Config::get('syntara::views.master'));
        $this->layout->title = Settings::get('site_name').' - Admin';
        $this->layout->breadcrumb = array();
    }
}