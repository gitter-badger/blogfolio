<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


/**
 * Loggued routes without permission
 */
Route::group(array('before' => 'basicAuth', 'prefix' => Config::get('syntara::config.uri')), function () {
    Route::get('', array(
        'as' => 'indexDashboard',
        'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@getIndex')
    );

    Route::get('logout', array(
        'as' => 'logout',
        'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@getLogout')
    );

    Route::get('access-denied', array(
        'as' => 'accessDenied',
        'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@getAccessDenied')
    );
});

/**
 * Loggued routes with permissions
 */
Route::group(array('before' => 'basicAuth|hasPermissions', 'prefix' => Config::get('syntara::config.uri')), function () {
    /**
     * User routes
     */
    Route::get('users', array(
        'as' => 'listUsers',
        'uses' => 'MrJuliuss\Syntara\Controllers\UserController@getIndex')
    );

    Route::delete('user/{userId}', array(
        'as' => 'deleteUsers',
        'uses' => 'MrJuliuss\Syntara\Controllers\UserController@delete')
    );

    Route::post('user/new', array(
        'as' => 'newUserPost',
        'uses' => 'MrJuliuss\Syntara\Controllers\UserController@postCreate')
    );

    Route::get('user/new', array(
        'as' => 'newUser',
        'uses' => 'MrJuliuss\Syntara\Controllers\UserController@getCreate')
    );

    Route::get('user/{userId}', array(
        'as' => 'showUser',
        'uses' => 'MrJuliuss\Syntara\Controllers\UserController@getShow')
    );

    Route::put('user/{userId}', array(
        'as' => 'putUser',
        'uses' => 'MrJuliuss\Syntara\Controllers\UserController@putShow')
    );

    Route::put('user/{userId}/activate', array(
        'as' => 'putActivateUser',
        'uses' => 'MrJuliuss\Syntara\Controllers\UserController@putActivate')
    );

    /**
     * Group routes
     */
    Route::get('groups', array(
        'as' => 'listGroups',
        'uses' => 'MrJuliuss\Syntara\Controllers\GroupController@getIndex')
    );

    Route::post('group/new', array(
        'as' => 'newGroupPost',
        'uses' => 'MrJuliuss\Syntara\Controllers\GroupController@postCreate')
    );

    Route::get('group/new', array(
        'as' => 'newGroup',
        'uses' => 'MrJuliuss\Syntara\Controllers\GroupController@getCreate')
    );

    Route::delete('group/{groupId}', array(
        'as' => 'deleteGroup',
        'uses' => 'MrJuliuss\Syntara\Controllers\GroupController@delete')
    );

    Route::get('group/{groupId}', array(
        'as' => 'showGroup',
        'uses' => 'MrJuliuss\Syntara\Controllers\GroupController@getShow')
    );

    Route::put('group/{groupId}', array(
        'as' => 'putGroup',
        'uses' => 'MrJuliuss\Syntara\Controllers\GroupController@putShow')
    );

    Route::delete('group/{groupId}/user/{userId}', array(
        'as' => 'deleteUserGroup',
        'uses' => 'MrJuliuss\Syntara\Controllers\GroupController@deleteUserFromGroup')
    );

    Route::post('group/{groupId}/user/{userId}', array(
        'as' => 'addUserGroup',
        'uses' => 'MrJuliuss\Syntara\Controllers\GroupController@addUserInGroup')
    );

    /**
     * Permission routes
     */
    Route::get('permissions', array(
        'as' => 'listPermissions',
        'uses' => 'MrJuliuss\Syntara\Controllers\PermissionController@getIndex')
    );

    Route::delete('permission/{permissionId}',array(
        'as' => 'deletePermission',
        'uses' => 'MrJuliuss\Syntara\Controllers\PermissionController@delete')
    );

    Route::get('permission/new', array(
        'as' => 'newPermission',
        'uses' => 'MrJuliuss\Syntara\Controllers\PermissionController@getCreate')
    );

    Route::post('permission/new', array(
        'as' => 'newPermissionPost',
        'uses' => 'MrJuliuss\Syntara\Controllers\PermissionController@postCreate')
    );

    Route::get('permission/{permissionId}', array(
        'as' => 'showPermission',
        'uses' => 'MrJuliuss\Syntara\Controllers\PermissionController@getShow')
    );

    Route::put('permission/{permissionId}', array(
        'as' => 'putPermission',
        'uses' => 'MrJuliuss\Syntara\Controllers\PermissionController@putShow')
    );
});

/**
 * Unlogged routes
 */
Route::group(array('before' => 'notAuth', 'prefix' => Config::get('syntara::config.uri')), function () {
    Route::get('login', array(
        'as' => 'getLogin',
        'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@getLogin')
    );

    Route::post('login', array(
        'as' => 'postLogin',
        'uses' => 'MrJuliuss\Syntara\Controllers\DashboardController@postLogin')
    );
});

Route::group(array('prefix' => Config::get('syntara::config.uri')), function () {
    /**
     * Activate a user (with view)
     */
    Route::get('user/activation/{activationCode}', array(
        'as' => 'getActivate',
        'uses' => 'MrJuliuss\Syntara\Controllers\UserController@getActivate')
    );
});


/**
 * Admin routes
 */
Route::group(array('before' => 'basicAuth|hasPermissions', 'prefix' => Config::get('syntara::config.uri')), function()
{
	/**
     * Settings routes
     */
    Route::get('settings', array(
        'as' => 'indexSettings',
        'uses' => 'SettingsController@index')
    );

    Route::put('settings', array(
        'as' => 'putSettings',
        'uses' => 'SettingsController@store')
    );

    /**
     * Blog Categories routes
     */
    Route::get('blog/categories', array(
        'as' => 'indexCategories',
        'uses' => 'BlogController@indexCategories')
    );
    Route::get('blog/categories/new', array(
        'as' => 'newCategory',
        'uses' => 'BlogController@newCategory')
    );
    Route::get('blog/categories/{id}', array(
        'as' => 'showCategory',
        'uses' => 'BlogController@showCategory')
    );
    Route::put('blog/categories/{id}', array(
        'as' => 'updateCategory',
        'uses' => 'BlogController@updateCategory')
    );
    Route::delete('blog/categories/{id}', array(
        'as' => 'deleteCategory',
        'uses' => 'BlogController@deleteCategory')
    );
    Route::post('blog/categories/new', array(
        'as' => 'storeCategory',
        'uses' => 'BlogController@storeCategory')
    );

    /**
     * Blog Posts routes
     */
    Route::get('blog/posts', array(
        'as' => 'indexPosts',
        'uses' => 'BlogController@indexPosts')
    );
    Route::get('blog/posts/new', array(
        'as' => 'newPost',
        'uses' => 'BlogController@newPost')
    );
    Route::get('blog/posts/{id}', array(
        'as' => 'showPost',
        'uses' => 'BlogController@showPost')
    );
    Route::put('blog/posts/{id}', array(
        'as' => 'updatePost',
        'uses' => 'BlogController@updatePost')
    );
    Route::delete('blog/posts/{id}', array(
        'as' => 'deletePost',
        'uses' => 'BlogController@deletePost')
    );
    Route::post('blog/posts/new', array(
        'as' => 'storePost',
        'uses' => 'BlogController@storePost')
    );


    /**
     * Blog Comments routes
     */
    Route::get('blog/comments', array(
        'as' => 'indexComments',
        'uses' => 'BlogController@indexComments')
    );
    Route::get('blog/comments/{id}', array(
        'as' => 'showComment',
        'uses' => 'BlogController@showComment')
    );
    Route::put('blog/comments/{id}', array(
        'as' => 'updateComment',
        'uses' => 'BlogController@updateComment')
    );
    Route::delete('blog/comments/{id}', array(
        'as' => 'deletePost',
        'uses' => 'BlogController@deleteComment')
    );

    /**
     * Portfolios routes
     */
    Route::get('portfolio', array(
        'as' => 'indexPortfolios',
        'uses' => 'PortfolioController@indexPortfolios')
    );
    Route::get('portfolio/new', array(
        'as' => 'newPortfolio',
        'uses' => 'PortfolioController@newPortfolio')
    );
    Route::get('portfolio/{id}', array(
        'as' => 'showPortfolio',
        'uses' => 'PortfolioController@showPortfolio')
    );
    Route::put('portfolio/{id}', array(
        'as' => 'updatePortfolio',
        'uses' => 'PortfolioController@updatePortfolio')
    );
    Route::delete('portfolio/{id}', array(
        'as' => 'deletePortfolio',
        'uses' => 'PortfolioController@deletePortfolio')
    );
});