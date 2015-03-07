<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(array('prefix' => 'developer'), function(){

    //login page
    Route::get('/', array(
       'as' => 'developer.index',
       'uses' => 'DeveloperController@index'
    ));

    Route::get('/sign-up', array(
        'as' => 'developer.sign-up',
        'uses' => 'Auth\AuthController@getRegister'
    ));

    Route::post('/register', array(
        'as' => 'developer.register',
        'uses' => 'Auth\AuthController@postRegister'
    ));

    Route::get('/sign-in', array(
        'as' => 'developer.sign-in',
        'uses' => 'Auth\AuthController@getLogin'
    ));

    Route::post('/login', array(
        'as' => 'developer.login',
        'uses' => 'Auth\AuthController@postLogin'
    ));

    Route::get('/dashboard', array(
        'as' => 'developer.dashboard',
        'uses' => 'DeveloperController@dashboard'
    ));

    Route::get('/logout', array(
        'as' => 'developer.logout',
        'uses' => 'Auth\AuthController@getLogout'
    ));
});