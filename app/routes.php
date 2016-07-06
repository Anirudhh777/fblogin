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

Route::get('/', function()
{
	$user = array();
	$user_pages = array();
	if(Auth::check()) {
		$user = Auth::user();
		$user_pages = Session::get('pages');
		// var_dump($user_pages);
	}
	return View::make('hello', array('user' => $user), array('user_pages' => $user_pages));
});

Route::get('login/fb', 'LoginFacebookController@login');
Route::get('login/fb/callback', 'LoginFacebookController@callback');
Route::get('logout', function(){
	Auth::logout();
	return Redirect::to('/');
});
Route::get('page/{pageid}/{token}', 'LoginFacebookController@pageCallback', function($pageid, $token){});
Route::get('/page', function()
{
	$fbtoken = array();
	$page_insight = array();
	$page_insight = Session::get('page_insight');
	$fbtoken = Session::get('token_fb');
	return View::make('page', array('page_insight' => $page_insight), array('fbtoken' => $fbtoken));
});

Route::get('back/page/{token}', 'LoginFacebookController@pageBack', function($token){});