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

Route::get('test', function(){
	return "Hello World!";
});

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

Route::get('/header1', function(){
	date_default_timezone_set('America/New_York');
/*	$startDate = ChampSales::orderBy('start_date', 'desc')->take(1)->get();
	foreach ($startDate as $value) {
		$endDate = $value->start_date;
		$date = new DateTime($endDate);
		$date->sub(new DateInterval('P1D'));
		//$date->sub(new DateInterval('P1D'));
		$endDate = $date->format("Y-m-d");
	}*/
	//echo $endDate;

	$lastInsertEndDate = ChampSales::orderBy('end_date', 'desc')->first();
	//echo $lastInsertEndDate->end_date;

	$latestEndDate = new DateTime($lastInsertEndDate->end_date);


	$today = new DateTime("now");
	$weekday=$latestEndDate->format("l");

	if ($weekday=="Monday") {
		$latestEndDate->sub(new DateInterval("P3D"));
	} else {
		$latestEndDate->sub(new DateInterval("P4D"));
	}



	$lastSaleEndDate = $latestEndDate->format("Y-m-d");
	//echo $lastSaleEndDate;



	if (Request::ajax()) {

		/*$champ_sales = ChampSales::whereRaw($today.' between start_date and end_date')->take(3)->get();
		$skin_sales = SkinSales::whereRaw($today.' between start_date and end_date')->take(3)->get();*/

		$champ_sales = ChampSales::where('end_date', '=', $lastSaleEndDate)->take(3)->get();
		$skin_sales = SkinSales::where('end_date', '=', $lastSaleEndDate)->take(3)->get();

		//$champ_sales = ChampSales::where('end_date', '=', $endDate)->take(3)->get();
		//$skin_sales = SkinSales::where('end_date', '=', $endDate)->take(3)->get();
		return View::make('saleContent')->with('champ_sales', $champ_sales)->with('skin_sales', $skin_sales);
	}
});

Route::get('/header2', function(){
	date_default_timezone_set('America/New_York');
	if (Request::ajax()) {

		$champ_sales = ChampSales::whereRaw('CURDATE() between start_date and end_date')->take(3)->get();
		$skin_sales = SkinSales::whereRaw('CURDATE() between start_date and end_date')->take(3)->get();

/*		$champ_sales = ChampSales::orderBy('start_date', 'desc')->take(3)->get();
		$skin_sales=SkinSales::orderBy('start_date', 'desc')->take(3)->get();*/
		return View::make('saleContent')->with('champ_sales', $champ_sales)->with('skin_sales', $skin_sales);
	}
});

Route::get('/header3', function(){
	date_default_timezone_set('America/New_York');

	$today = new DateTime("now");
	$weekday=$today->format("l");

	if ($weekday=="Thursday") {
		$today->add(new DateInterval("P1D"));
	} else {
		$today->add(new DateInterval("P1D"));
	}

	$nextSaleEndDate = $today->format("Y-m-d");

	echo $nextSaleEndDate;


	if (Request::ajax()) {

		$champ_sales = ChampSales::where('start_date', '=', $nextSaleEndDate)->take(3)->get();
		$skin_sales = SkinSales::where('start_date', '=', $nextSaleEndDate)->take(3)->get();

/*		$champ_sales = ChampSales::orderBy('start_date', 'desc')->take(3)->get();
		$skin_sales=SkinSales::orderBy('start_date', 'desc')->take(3)->get();*/
		return View::make('saleContent')->with('champ_sales', $champ_sales)->with('skin_sales', $skin_sales);
	}
});











