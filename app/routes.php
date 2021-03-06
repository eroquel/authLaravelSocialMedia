<?php
/*test views*/
Route::get('welcome', function()
{
	return View::make('emails/welcome');
});

/*Controls of auth*/
Route::get('login', 'AuthController@showLogin');
Route::post('login', 'AuthController@postLogin');
Route::get('logout', 'AuthController@logout');

Route::get('showRegister', 'AuthController@registerUser'); //show view new user
Route::post('sign-up', ['as' => 'register', 'uses' => 'UserController@register' ] );//register new user

Route::get('passRecovery', 'UserController@showPassRecovery');

Route::post('password/reset', ['as' => 'sendMailRecovery', 'uses' => 'UserController@sendMailRecovery' ] );

Route::get('password/reset/{token}', ['as' => 'showResetPass', 'uses' => 'UserController@showResetPass' ] );
Route::post('password/reset/{token}', ['as' => 'resetPass', 'uses' => 'UserController@resetPass' ] );

/*routes for login Social*/
Route::get('login/fb', 'UserController@afterFacebook' );
Route::get('login/fb/callback', 'UserController@loginFacebook' );

Route::get('login/tw', 'UserController@afterTwitter' );
Route::get('login/tw/callback', 'UserController@loginTwitter' );




/*private routes only for users auth*/
Route::group(['before' => 'auth'], function()
{
	Route::get('/', 'HomeController@showWelcome');

	Route::get('dash', 'AuthController@showWelcome');

	Route::post('updateUser', ['as' => 'updateUser', 'uses' => 'UserController@updateUser' ] );

	Route::post('uploadImage', ['as' => 'uploadImage', 'uses' => 'UserController@uploadImage' ] );

	Route::get('showSocialNetworking', 'UserController@getSocialNetworking' );
});
