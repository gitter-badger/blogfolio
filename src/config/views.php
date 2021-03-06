<?php

return array(
    // Layouts Front
    'frontMaster' => 'blogfolio::layouts.frontend.master',
    'frontHeader' => 'blogfolio::layouts.frontend.header',
    'frontContent' => 'blogfolio::layouts.frontend.content',
    'frontHeader' => 'blogfolio::layouts.frontend.header',

    // layouts
    'master' => 'blogfolio::layouts.dashboard.master',
    'header' => 'blogfolio::layouts.dashboard.header',
    'left' => 'blogfolio::layouts.dashboard.left',
    'content' => 'blogfolio::layouts.dashboard.content',


    // dashboard
    'dashboard-index' => 'blogfolio::dashboard.index',
    'login' => 'blogfolio::dashboard.login',
    'error' => 'blogfolio::dashboard.error',

    // users
    'users-index' => 'blogfolio::user.index-user',
    'users-list' => 'blogfolio::user.list-users',
    'user-create' => 'blogfolio::user.new-user',
    'user-informations' => 'blogfolio::user.user-informations',
    'user-profile' => 'blogfolio::user.show-user',
    'user-activation' => 'blogfolio::user.activation',

    // groups
    'groups-index' => 'blogfolio::group.index-group',
    'groups-list' => 'blogfolio::group.list-groups',
    'group-create' => 'blogfolio::group.new-group',
    'users-in-group' => 'blogfolio::group.list-users-group',
    'group-edit' => 'blogfolio::group.show-group',

    // permissions
    'permissions-index' => 'blogfolio::permission.index-permission',
    'permissions-list' => 'blogfolio::permission.list-permissions',
    'permission-create' => 'blogfolio::permission.new-permission',
    'permission-edit' => 'blogfolio::permission.show-permission',
);