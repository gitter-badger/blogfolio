<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{Gravatar::src(Sentry::getUser()->email, 215)}}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Hello, {{ Sentry::getUser()->username }}</p>

                <a href="{{ URL::route('showUser', Sentry::getUser()->id ) }}"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>


        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="active">
                <a href="{{ URL::route('indexDashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>{{trans("syntara::breadcrumbs.dashboard")}}</span>
                </a>
            </li>
            {{ (!empty($navPages)) ? $navPages : '' }}
            @if (Sentry::check())
                @if($currentUser->hasAccess('view-users-list') || $currentUser->hasAccess('groups-management'))
                <li class="treeview" >
                    <a href="#"><i class="fa fa-user"></i>
                        <span>{{ trans('syntara::navigation.users') }}</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        @if($currentUser->hasAccess('view-users-list'))
                        <li><a href="{{ URL::route('listUsers') }}"><i class="fa fa-users"></i> {{ trans('syntara::navigation.users') }}</a></li>
                        @endif

                        @if($currentUser->hasAccess('groups-management'))
                        <li><a href="{{ URL::route('listGroups') }}"><i class="fa fa-group"></i> {{ trans('syntara::navigation.groups') }}</a></li>
                        @endif
                        @if($currentUser->hasAccess('permissions-management'))
                        <li><a href="{{ URL::route('listPermissions') }}"><i class="fa fa-cogs"></i> {{ trans('syntara::navigation.permissions') }}</a></li>
                        @endif
                    </ul>
                </li>
                @endif
                 @if($currentUser->hasAccess('view-users-list') || $currentUser->hasAccess('groups-management'))
                <li>
                    <a href="{{ URL::route('indexSettings') }}">
	                    <i class="fa fa-cogs"></i> <span>{{trans("blogfolio::breadcrumbs.Globalsettings")}}</span>
	                </a>
                </li>
                @endif
                @if($currentUser->hasAccess('indexPosts'))
                <li class="treeview" >
                    <a href="#" class="active"><i class="fa fa-file-text-o"></i>
                        <span>{{ trans('blogfolio::navigation.blog') }}</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        @if($currentUser->hasAccess('indexPosts'))
                        <li><a href="{{ URL::route('indexPosts') }}"><i class="fa fa-files-o"></i> {{ trans('blogfolio::navigation.posts') }}</a></li>
                        @endif
                        @if($currentUser->hasAccess('comments-management'))
                        <li><a href="{{ URL::route('indexComments') }}"><i class="fa fa-comments-o"></i> {{ trans('blogfolio::navigation.comments') }}</a></li>
                        @endif
                        @if($currentUser->hasAccess('blogCategories-management'))
                        <li><a href="{{ URL::route('indexCategories') }}"><i class="fa fa-th-list"></i> {{ trans('blogfolio::navigation.categories') }}</a></li>
                        @endif
                    </ul>
                </li>
                @endif
                @if($currentUser->hasAccess('indexPorfolios'))
                <li class="treeview" >
                    <a href="#" class="active"><i class="fa fa-book"></i>
                        <span>{{ trans('blogfolio::navigation.portfolio') }}</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        @if($currentUser->hasAccess('view-portfolios-list'))
                        <li ><a href="{{ URL::route('indexPortfolios') }}"><i class="fa fa-book"></i> {{ trans('blogfolio::navigation.portfolios') }}</a></li>
                        @endif
                        @if($currentUser->hasAccess('comments-management'))
                        <li><a href="{{ URL::route('indexComments') }}"><i class="fa fa-comments-o"></i> {{ trans('blogfolio::navigation.comments') }}</a></li>
                        @endif
                        @if($currentUser->hasAccess('blogCategories-management'))
                        <li><a href="{{ URL::route('indexCategories') }}"><i class="fa fa-th-list"></i> {{ trans('blogfolio::navigation.categories') }}</a></li>
                        @endif
                    </ul>
                </li>
                @endif
                {{ (!empty($navPagesRight)) ? $navPagesRight : '' }}
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
