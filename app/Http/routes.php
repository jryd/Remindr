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

Route::get('/', function () {
    if (! Auth::guest())
    {
    	if (Auth::user()->confirmed != 1)
    	{
    		flash()->error('You need to verify your email address before you can log in. Please check your emails for your verification email.');

    		Auth::logout();
    	}
    }

    return view('home');
});

//Verify account
Route::get('register/verify/{token}', 'RegistrationController@confirmEmail');

//Authentication routes
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::post('auth/logout', 'Auth\AuthController@getLogout');
Route::controllers([
	'password' => 'Auth\PasswordController',
	]);

//Remindr Controller
Route::resource('remindr', 'RemindController');