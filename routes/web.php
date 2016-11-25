<?php

Route::get('/', ['as' => 'home', 'uses' => 'SiteController@home']);

Route::post('subscribe', ['as' => 'subscribe', 'uses' => 'SiteController@subscribe']);

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
    }
);
