<?php

return array(
    'dashboard' => array(
        array(
            'title' => trans('syntara::breadcrumbs.dashboard'),
            'link' => URL::current(),
            'icon' => 'glyphicon-home'
        )
    ),
    'login' => array(
        array(
            'title' => trans('syntara::breadcrumbs.login'),
            'link' => URL::route('getLogin'),
            'icon' => 'glyphicon-user'
        )
    ),
    'users' => array(
        array(
            'title' => trans('syntara::breadcrumbs.users'),
            'link' => URL::route('listUsers'),
            'icon' => 'glyphicon-user'
        )
    ),
    'create_user' => array(
        array(
            'title' => trans('syntara::breadcrumbs.users'),
            'link' => URL::route('listUsers'),
            'icon' => 'glyphicon-user'
        ),
        array(
            'title' => trans('syntara::breadcrumbs.new-user'),
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'groups' => array(
        array(
            'title' => trans('syntara::breadcrumbs.groups'),
            'link' => URL::route('listGroups'),
            'icon' => 'glyphicon-list-alt'
        )
    ),
    'create_group' => array(
        array(
            'title' => trans('syntara::breadcrumbs.groups'),
            'link' => URL::route('listGroups'),
            'icon' => 'glyphicon-list-alt'
        ),
        array(
            'title' => trans('syntara::breadcrumbs.new-group'),
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'permissions' => array(
       array(
            'title' => trans('syntara::breadcrumbs.permissions'),
            'link' => URL::route('listPermissions'),
            'icon' => 'glyphicon-ban-circle'
        )
    ),
    'create_permission' => array(
        array(
            'title' => trans('syntara::breadcrumbs.permissions'),
            'link' => URL::route('listPermissions'),
            'icon' => 'glyphicon-ban-circle'
        ),
        array(
            'title' => trans('syntara::breadcrumbs.new-permission'),
            'link' => URL::current(),
            'icon' => 'glyphicon-plus-sign'
        )
    ),
    'settings' => array(
        array(
            'title' => trans('blogfolio::breadcrumbs.Globalsettings'),
            'link' => URL::route('indexSettings'),
            'icon' => 'fa fa-cog fa-spin'
        )
    ),
    'categories' => array(
        array(
            'title' => trans('blogfolio::navigation.categories'),
            'link' => URL::route('indexCategories'),
            'icon' => 'fa fa-tags'
        )
    ),
    'create_category' => array(
        array(
            'title' => trans('blogfolio::navigation.categories'),
            'link' => URL::route('indexCategories'),
            'icon' => 'fa fa-tags'
        )
    ),
    'posts' => array(
        array(
            'title' => trans('blogfolio::navigation.posts'),
            'link' => URL::route('indexPosts'),
            'icon' => 'fa fa-tags'
        )
    ),
    'create_post' => array(
        array(
            'title' => trans('blogfolio::navigation.posts'),
            'link' => URL::route('indexPosts'),
            'icon' => 'fa fa-tags'
        )
    ),
    'edit_post' => array(
        array(
            'title' => trans('blogfolio::navigation.posts'),
            'link' => URL::route('indexPosts'),
            'icon' => 'fa fa-tags'
        )
    ),
    'comments' => array(
        array(
            'title' => trans('blogfolio::navigation.comments'),
            'link' => URL::route('indexComments'),
            'icon' => 'fa fa-comments'
        )
    ),
    'edit_comment' => array(
        array(
            'title' => trans('blogfolio::navigation.comments'),
            'link' => URL::route('indexComments'),
            'icon' => 'fa fa-comments'
        )
    ),
    'portfolios' => array(
        array(
            'title' => trans('blogfolio::navigation.portfolios'),
            'link' => URL::route('indexPortfolios'),
            'icon' => 'fa fa-tags'
        )
    ),
    'create_portfolio' => array(
        array(
            'title' => trans('blogfolio::navigation.portfolios'),
            'link' => URL::route('indexPortfolios'),
            'icon' => 'fa fa-tags'
        )
    ),
    'edit_potfolio' => array(
        array(
            'title' => trans('blogfolio::navigation.portfolios'),
            'link' => URL::route('indexPortfolios'),
            'icon' => 'fa fa-tags'
        )
    ),
    'projects' => array(
        array(
            'title' => trans('blogfolio::navigation.projects'),
            'link' => URL::route('indexProjects'),
            'icon' => 'fa fa-file-code-o'
        )
    ),
    'create_project' => array(
        array(
            'title' => trans('blogfolio::navigation.projects'),
            'link' => URL::route('indexProjects'),
            'icon' => 'fa fa-file-code-o'
        )
    ),
    'edit_project' => array(
        array(
            'title' => trans('blogfolio::navigation.projectsprojects'),
            'link' => URL::route('indexProjects'),
            'icon' => 'fa fa-file-code-o'
        )
    ),
);