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

Route::get('/', array(
	'as' => 'home',
	'uses' => 'HomeController@home'
));

Route::get('/skin', array(
	'as' => 'skin',
	'uses' => 'SkinController@getSkins'
));

Route::get('/skin/{id}', array(
	'as' => 'single',
	'uses' => 'SkinController@showSkin'
));

Route::get('/champion', array(
	'as' => 'champion',
	'uses' => 'ChampionController@getChampions'
));

Route::get('/champion/{name}', array(
	'as' => 'single',
	'uses' => 'ChampionController@showChampion'
));

Route::get('users', function()
{
	$users = DB::table('skin_sales')->get();
	foreach ($users as $user)
	{
	     echo $user->skin."<br>";
	}
    return View::make('users');
});