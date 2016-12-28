<?php
Route::group(
  ['namespace' => 'Web'],
  function() {
      Route::get('/', ['as' => 'home', 'uses' => 'SiteController@home']);
      Route::post('subscribe', ['as' => 'subscribe', 'uses' => 'SubscriberController@postSubscriber']);
      Route::get('confirm/{email}/{token}', ['as' => 'confirm', 'uses' => 'SubscriberController@confirm']);
      Route::get('confirm_unsubscribe/{email}/{token}', ['as' => 'confirm-unsubscribe', 'uses' =>
          'SubscriberController@confirmUnsubscribe']);
      Route::get('unsubscribe/{email}/{token}', ['as' => 'unsubscribe', 'uses' => 'SubscriberController@unsubscribe']);
      Route::get('setting/{email}/{token}', ['as' => 'setting', 'uses' => 'SettingController@setting']);
      Route::post('setting', ['as' => 'setting.post', 'uses' => 'SettingController@settingPost']);
      Route::post('publish', ['as' => 'publish.post', 'uses' => 'SiteController@publishPost']);
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
        Route::get('log', ['as' => 'log', 'middleware' => 'user', 'uses' =>
            '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index']);
        Route::get('login', ['as' => 'login', 'uses' => 'AuthController@login']);
        Route::post('login', ['as' => 'login.post', 'uses' => 'AuthController@loginPost']);
        Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
        Route::get('dashboard', ['as' => 'admin.dashboard','uses' => 'PageController@index']);
        Route::get('contracts', ['as' => 'admin.contracts', 'uses' =>
            'PageController@contracts']);
        Route::get('settings', ['as' => 'admin.settings', 'uses' => 'SettingsController@index']);
        Route::post('settings', ['as' => 'admin.settings.post', 'uses' => 'SettingsController@save']);
    }
);
