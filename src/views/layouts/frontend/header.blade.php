<header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                        @if (!empty($settings['site_phone']))
                            <div class="top-number"><p><i class="fa fa-phone-square"></i>  {{$settings['site_phone']}}</p></div>
                        @endif
                    </div>
                    <div class="col-sm-6 col-xs-8">
                       <div class="social">
                        @if (count($socialLinks) > 0)
                            <ul class="social-share">
                        @foreach ($socialLinks as $name => $link)
                                <li><a href="{{$link}}"><i class="fa fa-{{$name}}"></i></a></li>
                        @endforeach
                            </ul>
                        @endif
                            <div class="search">
                                <form role="form">
                                    <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                                    <i class="fa fa-search"></i>
                                </form>
                           </div>
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"><img src="{{ asset("packages/ukadev/blogfolio/front/images/logo.png") }}" alt="logo"></a>
                </div>
                
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="{{Active::route(array('frontIndex')); }}"><a href="/">Home</a></li>
                        <li class="{{Active::route(array('frontAbout')); }}"><a href="/about">About Me</a></li>
                        <li class="{{Active::route(array('frontPortfolio')); }}"><a href="/portfolio">Portfolio</a></li>
                        <li class="{{Active::route(array('frontBlog')); }}"><a href="/blog">Blog</a></li> 
                        <li class="{{Active::route(array('frontContact')); }}"><a href="/contact">Contact</a></li>                        
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
        
    </header><!--/header-->