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
Route::pattern('id', '[0-9]+');

Route::get('/', array(
    'as' => 'frontIndex',
    'uses' => 'Ukadev\Blogfolio\Controllers\FrontendController@getIndex')
);
Route::get('/about', array(
    'as' => 'frontAbout',
    'uses' => 'Ukadev\Blogfolio\Controllers\FrontendController@getAbout')
);
Route::get('/contact', array(
    'as' => 'frontContact',
    'uses' => 'Ukadev\Blogfolio\Controllers\FrontendController@getContact')
);
Route::get('/blog', array(
    'as' => 'frontBlog',
    'uses' => 'Ukadev\Blogfolio\Controllers\FrontendController@getBlog')
);
Route::get('/blog/{slug}', array(
    'as' => 'frontBlogItem',
    'uses' => 'Ukadev\Blogfolio\Controllers\FrontendController@getBlogItem')
);
Route::get('/portfolio', array(
    'as' => 'frontPortfolio',
    'uses' => 'Ukadev\Blogfolio\Controllers\FrontendController@getportfolio')
);

/**
 * Loggued routes without permission
 */
Route::group(array('before' => 'basicAuth', 'prefix' => Config::get('syntara::config.uri')), function () {
    Route::get('', array(
        'as' => 'indexDashboard',
        'uses' => 'Ukadev\Blogfolio\Controllers\DashboardController@getIndex')
    );

    Route::get('logout', array(
        'as' => 'logout',
        'uses' => 'Ukadev\Blogfolio\Controllers\DashboardController@getLogout')
    );

    Route::get('access-denied', array(
        'as' => 'accessDenied',
        'uses' => 'Ukadev\Blogfolio\Controllers\DashboardController@getAccessDenied')
    );
});

/**
 * Unlogged routes
 */
Route::group(array('before' => 'notAuth', 'prefix' => Config::get('syntara::config.uri')), function () {
    Route::get('login', array(
        'as' => 'getLogin',
        'uses' => 'Ukadev\Blogfolio\Controllers\DashboardController@getLogin')
    );

    Route::post('login', array(
        'as' => 'postLogin',
        'uses' => 'Ukadev\Blogfolio\Controllers\DashboardController@postLogin')
    );
});

Route::group(array('prefix' => Config::get('syntara::config.uri')), function () {
    /**
     * Activate a user (with view)
     */
    Route::get('user/activation/{activationCode}', array(
        'as' => 'getActivate',
        'uses' => 'Ukadev\Blogfolio\Controllers\UserController@getActivate')
    );
});


/**
 * Admin routes
 */
Route::group(array('before' => 'basicAuth|hasPermissions', 'prefix' => Config::get('syntara::config.uri')), function(){

    /**
     * User routes
     */
    Route::get('users', array(
        'as' => 'listUsers',
        'uses' => 'Ukadev\Blogfolio\Controllers\UserController@getIndex')
    );

    Route::delete('user/{userId}', array(
        'as' => 'deleteUsers',
        'uses' => 'Ukadev\Blogfolio\Controllers\UserController@delete')
    );

    Route::post('user/new', array(
        'as' => 'newUserPost',
        'uses' => 'Ukadev\Blogfolio\Controllers\UserController@postCreate')
    );

    Route::get('user/new', array(
        'as' => 'newUser',
        'uses' => 'Ukadev\Blogfolio\Controllers\UserController@getCreate')
    );

    Route::get('user/{userId}', array(
        'as' => 'showUser',
        'uses' => 'Ukadev\Blogfolio\Controllers\UserController@getShow')
    );

    Route::put('user/{userId}', array(
        'as' => 'putUser',
        'uses' => 'Ukadev\Blogfolio\Controllers\UserController@putShow')
    );

    Route::put('user/{userId}/activate', array(
        'as' => 'putActivateUser',
        'uses' => 'Ukadev\Blogfolio\Controllers\UserController@putActivate')
    );

    /**
     * Group routes
     */
    Route::get('groups', array(
        'as' => 'listGroups',
        'uses' => 'Ukadev\Blogfolio\Controllers\GroupController@getIndex')
    );

    Route::post('group/new', array(
        'as' => 'newGroupPost',
        'uses' => 'Ukadev\Blogfolio\Controllers\GroupController@postCreate')
    );

    Route::get('group/new', array(
        'as' => 'newGroup',
        'uses' => 'Ukadev\Blogfolio\Controllers\GroupController@getCreate')
    );

    Route::delete('group/{groupId}', array(
        'as' => 'deleteGroup',
        'uses' => 'Ukadev\Blogfolio\Controllers\GroupController@delete')
    );

    Route::get('group/{groupId}', array(
        'as' => 'showGroup',
        'uses' => 'Ukadev\Blogfolio\Controllers\GroupController@getShow')
    );

    Route::put('group/{groupId}', array(
        'as' => 'putGroup',
        'uses' => 'Ukadev\Blogfolio\Controllers\GroupController@putShow')
    );

    Route::delete('group/{groupId}/user/{userId}', array(
        'as' => 'deleteUserGroup',
        'uses' => 'Ukadev\Blogfolio\Controllers\GroupController@deleteUserFromGroup')
    );

    Route::post('group/{groupId}/user/{userId}', array(
        'as' => 'addUserGroup',
        'uses' => 'Ukadev\Blogfolio\Controllers\GroupController@addUserInGroup')
    );

    /**
     * Permission routes
     */
    Route::get('permissions', array(
        'as' => 'listPermissions',
        'uses' => 'Ukadev\Blogfolio\Controllers\PermissionController@getIndex')
    );

    Route::delete('permission/{permissionId}',array(
        'as' => 'deletePermission',
        'uses' => 'Ukadev\Blogfolio\Controllers\PermissionController@delete')
    );

    Route::get('permission/new', array(
        'as' => 'newPermission',
        'uses' => 'Ukadev\Blogfolio\Controllers\PermissionController@getCreate')
    );

    Route::post('permission/new', array(
        'as' => 'newPermissionPost',
        'uses' => 'Ukadev\Blogfolio\Controllers\PermissionController@postCreate')
    );

    Route::get('permission/{permissionId}', array(
        'as' => 'showPermission',
        'uses' => 'Ukadev\Blogfolio\Controllers\PermissionController@getShow')
    );

    Route::put('permission/{permissionId}', array(
        'as' => 'putPermission',
        'uses' => 'Ukadev\Blogfolio\Controllers\PermissionController@putShow')
    );

	/**
     * Settings routes
     */
    Route::get('settings', array(
        'as' => 'indexSettings',
        'uses' => 'Ukadev\Blogfolio\Controllers\SettingsController@index')
    );

    Route::put('settings', array(
        'as' => 'putSettings',
        'uses' => 'Ukadev\Blogfolio\Controllers\SettingsController@store')
    );

    /**
     * Blog Categories routes
     */
    Route::get('blog/categories', array(
        'as' => 'indexCategories',
        'uses' => 'Ukadev\Blogfolio\Controllers\BlogController@indexCategories')
    );
    Route::get('blog/categories/new', array(
        'as' => 'newCategory',
        'uses' => 'Ukadev\Blogfolio\Controllers\BlogController@newCategory')
    );
    Route::get('blog/categories/{id}', array(
        'as' => 'showCategory',
        'uses' => 'Ukadev\Blogfolio\Controllers\BlogController@showCategory')
    );
    Route::put('blog/categories/{id}', array(
        'as' => 'updateCategory',
        'uses' => 'Ukadev\Blogfolio\Controllers\BlogController@updateCategory')
    );
    Route::delete('blog/categories/{id}', array(
        'as' => 'deleteCategory',
        'uses' => 'Ukadev\Blogfolio\Controllers\BlogController@deleteCategory')
    );
    Route::post('blog/categories/new', array(
        'as' => 'storeCategory',
        'uses' => 'Ukadev\Blogfolio\Controllers\BlogController@storeCategory')
    );

    /**
     * Blog Posts routes
     */
    Route::get('blog/posts', array(
        'as' => 'indexPosts',
        'uses' => 'Ukadev\Blogfolio\Controllers\BlogController@indexPosts')
    );
    Route::get('blog/posts/new', array(
        'as' => 'newPost',
        'uses' => 'Ukadev\Blogfolio\Controllers\BlogController@newPost')
    );
    Route::get('blog/posts/{id}', array(
        'as' => 'showPost',
        'uses' => 'Ukadev\Blogfolio\Controllers\BlogController@showPost')
    );
    Route::put('blog/posts/{id}', array(
        'as' => 'updatePost',
        'uses' => 'Ukadev\Blogfolio\Controllers\BlogController@updatePost')
    );
    Route::delete('blog/posts/{id}', array(
        'as' => 'deletePost',
        'uses' => 'Ukadev\Blogfolio\Controllers\BlogController@deletePost')
    );
    Route::post('blog/posts/new', array(
        'as' => 'storePost',
        'uses' => 'Ukadev\Blogfolio\Controllers\BlogController@storePost')
    );

    /**
     * Blog Comments routes
     */
    Route::get('blog/comments', array(
        'as' => 'indexComments',
        'uses' => 'Ukadev\Blogfolio\Controllers\BlogController@indexComments')
    );
    Route::get('blog/comments/{id}', array(
        'as' => 'showComment',
        'uses' => 'Ukadev\Blogfolio\Controllers\BlogController@showComment')
    );
    Route::put('blog/comments/{id}', array(
        'as' => 'updateComment',
        'uses' => 'Ukadev\Blogfolio\Controllers\BlogController@updateComment')
    );
    Route::delete('blog/comments/{id}', array(
        'as' => 'deletePost',
        'uses' => 'Ukadev\Blogfolio\Controllers\BlogController@deleteComment')
    );

    /**
     * Portfolios routes
     */
    // Route::get('portfolio', array(
    //     'as' => 'indexPortfolios',
    //     'uses' => 'Ukadev\Blogfolio\Controllers\PortfolioController@indexPortfolios')
    // );
    // Route::get('portfolio/new', array(
    //     'as' => 'newPortfolio',
    //     'uses' => 'Ukadev\Blogfolio\Controllers\PortfolioController@newPortfolio')
    // );
    // Route::post('portfolio/new', array(
    //     'as' => 'storePortfolio',
    //     'uses' => 'Ukadev\Blogfolio\Controllers\PortfolioController@storePortfolio')
    // );
    Route::get('portfolio', array(
        'as' => 'indexPortfolios',
        'uses' => 'Ukadev\Blogfolio\Controllers\PortfolioController@showPortfolio')
    );
    Route::put('portfolio', array(
        'as' => 'updatePortfolio',
        'uses' => 'Ukadev\Blogfolio\Controllers\PortfolioController@updatePortfolio')
    );
    // Route::delete('portfolio/{id}', array(
    //     'as' => 'deletePortfolio',
    //     'uses' => 'Ukadev\Blogfolio\Controllers\PortfolioController@deletePortfolio')
    // );

    /**
     * Portfolios projects routes
     */
    Route::post('portfolio/projects/uploadFile', array(
        'as' => 'uploadFile',
        'uses' => 'Ukadev\Blogfolio\Controllers\PortfolioController@uploadFile')
    );
    Route::delete('portfolio/projects/{id}', array(
        'as' => 'deleteProject',
        'uses' => 'Ukadev\Blogfolio\Controllers\PortfolioController@deleteProject')
    ); 
    Route::get('portfolio/projects', array(
        'as' => 'indexProjects',
        'uses' => 'Ukadev\Blogfolio\Controllers\PortfolioController@indexProjects')
    );
    Route::get('portfolio/projects/new', array(
        'as' => 'newProject',
        'uses' => 'Ukadev\Blogfolio\Controllers\PortfolioController@newProject')
    );
    Route::post('portfolio/projects/new', array(
        'as' => 'storeProject',
        'uses' => 'Ukadev\Blogfolio\Controllers\PortfolioController@storeProject')
    );
    Route::get('portfolio/projects/{id}', array(
        'as' => 'showProject',
        'uses' => 'Ukadev\Blogfolio\Controllers\PortfolioController@showProject')
    );
    Route::put('portfolio/projects/{id}', array(
        'as' => 'updateProject',
        'uses' => 'Ukadev\Blogfolio\Controllers\PortfolioController@updateProject')
    );

    /**
     * Language routes
     */
    Route::get('languages', array(
        'as' => 'indexLanguages',
        'uses' => 'Ukadev\Blogfolio\Controllers\LanguageController@index')
    );
    Route::get('languages/new', array(
        'as' => 'newLanguage',
        'uses' => 'Ukadev\Blogfolio\Controllers\LanguageController@newLanguage')
    );
    Route::post('languages/new', array(
        'as' => 'storeLanguage',
        'uses' => 'Ukadev\Blogfolio\Controllers\LanguageController@storeLanguage')
    );
    Route::get('languages/{id}', array(
        'as' => 'showLanguage',
        'uses' => 'Ukadev\Blogfolio\Controllers\LanguageController@showLanguage')
    );
    Route::put('languages/{id}', array(
        'as' => 'updateLanguage',
        'uses' => 'Ukadev\Blogfolio\Controllers\LanguageController@updateLanguage')
    );
    Route::delete('languages/{id}', array(
        'as' => 'deleteLanguage',
        'uses' => 'Ukadev\Blogfolio\Controllers\LanguageController@deleteLanguage')
    );
});