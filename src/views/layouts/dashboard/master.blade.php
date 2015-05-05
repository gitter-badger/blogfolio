<html>
    <head>
        <meta charset="UTF-8">
        <title>{{ (!empty($siteName)) ? $siteName : "Blogfolio"}} - {{isset($title) ? $title : '' }}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.3.2 -->
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Datepicker -->
        <link href="{{ asset("packages/ukadev/blogfolio/plugins/datepicker/datepicker3.css") }}" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="{{ asset("packages/ukadev/blogfolio/plugins/fullcalendar/fullcalendar.css") }}" rel="stylesheet" type="text/css" />
        <!-- Main style -->
        <link href="{{ asset("packages/ukadev/blogfolio/css/Blogfolio.css") }}" rel="stylesheet" type="text/css" />
        <!-- bootstrap css tags -->
        <link href="{{ asset("packages/ukadev/blogfolio/css/tags.css") }}" rel="stylesheet" type="text/css" />
        <!-- Multi Select -->
        <link href="{{ asset("packages/ukadev/blogfolio/css/multi-select.css") }}" rel="stylesheet" type="text/css" />
		<!--  text editor -->
        <link rel="stylesheet" href="{{ asset("packages/ukadev/blogfolio/plugins/editor/summernote.css") }}">

        @if (!empty($favicon))
        <link rel="icon" {{ !empty($faviconType) ? 'type="$faviconType"' : '' }} href="{{ $favicon }}" />
        @endif
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <!-- jQuery 2.1.3 -->
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    </head>
    <body class="skin-blue fixed">
        @include(Config::get('syntara::views.header'))

        <div class="wrapper row-offcanvas row-offcanvas-left">
            @include(Config::get('blogfolio::views.left'))

            @include(Config::get('blogfolio::views.content'))

        </div>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- FastClick -->
        <script src='{{ asset("packages/ukadev/blogfolio/plugins/fastclick/fastclick.min.js") }}'></script>
        <!-- datepicker -->
        <script src="{{ asset("packages/ukadev/blogfolio/plugins/datepicker/bootstrap-datepicker.js") }}" type="text/javascript"></script>
        <!-- SlimScroll 1.3.0 -->
        <script src="{{ asset("packages/ukadev/blogfolio/plugins/slimScroll/jquery.slimscroll.min.js") }}" type="text/javascript"></script>
        <!-- Bootstrap Tags js -->
        <script src="{{ asset("packages/ukadev/blogfolio/js/tags.js") }}" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{ asset("packages/ukadev/blogfolio/plugins/editor/summernote.js") }}" type="text/javascript"></script>
        <!-- Multi Select -->
        <script src="{{ asset("packages/ukadev/blogfolio/js/jquery.multi-select.js") }}" type="text/javascript"></script>
        <!-- blogfolio App -->
        <script src="{{ asset("packages/ukadev/blogfolio/js/app.js") }}" type="text/javascript"></script>
    </body>
</html>
