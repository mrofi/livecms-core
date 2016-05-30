<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
liveCMSRouter($router, function ($router, $adminSlug, $subDomain, $subFolder) {

    $router->get('coming-soon', ['as' => 'coming-soon', function () {
        return view('coming-soon');
    }]);

    $router->get('redirect', ['as' => 'redirect', function () {
        return redirect()->to(request()->get('to'));
    }]);

    // PROFILE AREA

    $userSlug = globalParams('slug_userhome', config('livecms.slugs.userhome'));
    $router->group(['prefix' => $userSlug, 'namespace' => 'User', 'middleware' => 'auth'], function ($router) {

        $router->get('/', ['as' => 'user.home', function () {
            $bodyClass        = 'skin-blue sidebar-mini sidebar-collapse';

            return view('user', compact('bodyClass'));
        }]);

        $router->resource('profile', 'ProfileController');
    
    });

    // ADMIN AREA
    $router->group(['prefix' => $adminSlug, 'namespace' => 'Backend', 'middleware' => 'auth'], function ($router) {
        
        $router->get('/', ['as' => 'admin.home', function () {
            return view('admin.home');
        }]);

        $router->resource('permalink', 'PermalinkController');
        $router->resource('setting', 'SettingController');
        $router->resource('user', 'UserController');
        $router->resource('site', 'SiteController');

        $articleSlug            = globalParams('slug_article', config('livecms.slugs.article'));
        $categorySlug           = globalParams('slug_category', config('livecms.slugs.category'));
        $tagSlug                = globalParams('slug_tag', config('livecms.slugs.tag'));
        $staticpageSlug         = globalParams('slug_staticpage', config('livecms.slugs.staticpage'));
        $teamSlug               = globalParams('slug_team', config('livecms.slugs.team'));
        $projectSlug            = globalParams('slug_project', config('livecms.slugs.project'));
        $clientSlug             = globalParams('slug_client', config('livecms.slugs.client'));
        $projectCategorySlug    = globalParams('slug_projectcategory', config('livecms.slugs.projectcategory'));
        $gallerySlug            = globalParams('slug_gallery', config('livecms.slugs.gallery'));
        $contactSlug            = globalParams('slug_contact', config('livecms.slugs.contact'));

        $router->resource($categorySlug, 'CategoryController');
        $router->resource($tagSlug, 'TagController');
        $router->resource($articleSlug, 'ArticleController');
        $router->resource($staticpageSlug, 'StaticPageController');
        $router->resource($teamSlug, 'TeamController');
        $router->resource($projectSlug, 'ProjectController');
        $router->resource($projectCategorySlug, 'ProjectCategoryController');
        $router->resource($clientSlug, 'ClientController');
        $router->resource($gallerySlug, 'GalleryController');
        $router->resource($contactSlug, 'ContactController');

    });

    // PROFILE AREA

    $userSlug = globalParams('slug_userhome', config('livecms.slugs.userhome'));

    $router->group(['prefix' => $userSlug, 'namespace' => 'User', 'middleware' => 'auth'], function ($router) {
        $articleSlug            = globalParams('slug_article', config('livecms.slugs.article'));
        $router->resource($articleSlug, 'ArticleController');
    });

    // FRONTEND
    $router->group(['namespace' => 'Frontend'], function ($router) {
        $router->get('/', ['as' => 'home', 'uses' => 'PageController@home']);
        $router->get('{arg0?}/{arg1?}/{arg2?}/{arg3?}/{arg4?}/{arg5?}', 'PageController@routes');
    });

        // AUTH
    $router->auth();

    $router->get('register', function () {
        return redirect()->route('user.home');
    });

});
