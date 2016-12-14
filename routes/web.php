<?php

Route::get('/', ['as' => 'home', 'uses' => 'SiteController@home']);
Route::post('subscribe', ['as' => 'subscribe', 'uses' => 'SiteController@postSubscriber']);
Route::get('confirm/{email}/{token}', ['as' => 'confirm', 'uses' => 'SiteController@confirm']);

Route::get('confirm_unsubscribe/{email}/{token}', ['as' => 'confirm-unsubscribe', 'uses' =>
    'SiteController@confirmUnsubscribe']);
Route::get('unsubscribe/{email}/{token}', ['as' => 'unsubscribe', 'uses' => 'SiteController@unsubscribe']);

Route::get('setting/{email}/{token}', ['as' => 'setting', 'uses' => 'SiteController@setting']);
Route::post('setting', ['as' => 'setting.post', 'uses' => 'SiteController@settingPost']);

Route::post('publish', ['as' => 'publish.post', 'uses' => 'SiteController@publishPost']);

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
|
*/
Route::group(
    ['namespace' => 'Admin'],
    function () {
        Route::get('login', ['as' => 'login', 'uses' => 'AuthController@login']);
        Route::post('login', ['as' => 'login.post', 'uses' => 'AuthController@loginPost']);
        Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);

        Route::get('dashboard', ['as' => 'admin.dashboard','uses' => 'PageController@index']);

        Route::get('published_contract', ['as' => 'published_contract', 'uses' =>
            'PageController@published_contract']);
    }
);
