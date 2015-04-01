<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{isset($title) ? ' - '.$title : '' }}</title>
    
    <!-- core CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset("packages/ukadev/blogfolio/Blogfolio/front/css/animate.min.css") }}" rel="stylesheet">
    <link href="{{ asset("packages/ukadev/blogfolio/Blogfolio/front/css/prettyPhoto.css") }}" rel="stylesheet">
    <link href="{{ asset("packages/ukadev/blogfolio/Blogfolio/front/css/main.css") }}" rel="stylesheet">
    <link href="{{ asset("packages/ukadev/blogfolio/Blogfolio/front/css/responsive.css") }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{ asset("packages/ukadev/blogfolio/Blogfolio/front/js/html5shiv.js") }}"></script>
    <script src="{{ asset("packages/ukadev/blogfolio/Blogfolio/front/js/respond.min.js") }}"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{ asset("packages/ukadev/blogfolio/Blogfolio/front/images/ico/favicon.ico") }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset("packages/ukadev/blogfolio/Blogfolio/front/images/ico/apple-touch-icon-144-precomposed.png") }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset("packages/ukadev/blogfolio/Blogfolio/front/images/ico/apple-touch-icon-114-precomposed.png") }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset("packages/ukadev/blogfolio/Blogfolio/front/images/ico/apple-touch-icon-72-precomposed.png") }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset("packages/ukadev/blogfolio/Blogfolio/front/images/ico/apple-touch-icon-57-precomposed.png") }}">
</head><!--/head-->
<body class="homepage">
    @include(Config::get('blogfolio::views.frontHeader'))
    @include(Config::get('blogfolio::views.frontContent'))
    <section id="conatcat-info">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="media contact-info wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="pull-left">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="media-body">
                            <h2>Have a question or need a custom quote?</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation +0123 456 70 80</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.container-->    
    </section><!--/#conatcat-info-->
    
    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2013 <a target="_blank" href="http://shapebootstrap.net/" title="Free Twitter Bootstrap WordPress Themes and HTML templates">ShapeBootstrap</a>. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Faq</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->
    <script src="//code.jquery.com/jquery-2.1.3.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset("packages/ukadev/blogfolio/Blogfolio/js/jquery-ui-1.10.3.min.js") }}"></script>
    <script src="{{ asset("packages/ukadev/blogfolio/Blogfolio/front/js/jquery.prettyPhoto.js") }}"></script>
    <script src="{{ asset("packages/ukadev/blogfolio/Blogfolio/front/js/jquery.isotope.min.js") }}"></script>
    <script src="{{ asset("packages/ukadev/blogfolio/Blogfolio/front/js/main.js") }}"></script>
    <script src="{{ asset("packages/ukadev/blogfolio/Blogfolio/front/js/wow.min.js") }}"></script>
</body>
</html>