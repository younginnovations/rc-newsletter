<?php

Route::get(
    '/',
    function () {
        return view('welcome');
    }
);

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
