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

Route::get('/history', array(
	'as' => 'history',
	'uses' => 'HistoryController@showHistory'
));

Route::get('/skinhistory', array(
	'as' => 'skinhistory',
	'uses' => 'SkinHistoryController@showSkinHistory'
));

Route::get('/rp/{rp}', array(
	'as' => 'skinhistoryRP',
	'uses' => 'SkinHistoryController@specificRP'
));

Route::get('/rp/all', array(
	'as' => 'skinhistoryAll',
	'uses' => 'SkinHistoryController@showSkinHistory'
));

Route::get('/header1', function(){
	

/*	$lastInsertEndDate = ChampSales::orderBy('end_date', 'desc')->first();

	$latestEndDate = new DateTime($lastInsertEndDate->end_date);*/

	$today = new DateTime("now");
	$latestEndDate=new DateTime("now");
	$weekday=$today->format("l");
	$hour = $today->format("Y-m-d H:i:s");
	//echo $hour;

	if ($weekday=="Sunday") {
		$latestEndDate->sub(new DateInterval("P2D"));
		//echo "hello sunday";
	} elseif ($weekday=="Monday") {
		$latestEndDate->sub(new DateInterval("P3D"));
		//echo "hello monday";
	} elseif ($weekday=="Tuesday") {
		$latestEndDate->sub(new DateInterval("P1D"));
		//echo "hello tuesday";
	} elseif ($weekday=="Wednesday") {
		$latestEndDate->sub(new DateInterval("P2D"));
		//echo "hello Wednesday";
	} elseif ($weekday=="Thursday") {
		$latestEndDate->sub(new DateInterval("P3D"));
		//echo "hello Thursday";
	} elseif ($weekday=="Friday") {
		$latestEndDate = new DateTime("now");
		//echo "hello friday";
	} elseif ($weekday=="Saturday") {
		$latestEndDate->sub(new DateInterval("P1D"));
		//echo "hello Saturday";
	}

	$lastSaleEndDate = $latestEndDate->format("Y-m-d");

	if (Request::ajax()) {

		$champ_sales = ChampSales::where('end_date', '=', $lastSaleEndDate)->orderBy("sale_price", "desc")->take(3)->get();
		$skin_sales = SkinSales::where('end_date', '=', $lastSaleEndDate)->orderBy("sale_price", "desc")->take(3)->get();

		return View::make('saleContent')->with('champ_sales', $champ_sales)->with('skin_sales', $skin_sales);
	}
});

Route::get('/header2', function(){
	
	$today = new DateTime("now");
	$latestEndDate=new DateTime("now");
	$weekday=$today->format("l");
	//echo $weekday;

	if ($weekday=="Sunday") {
		$latestEndDate->sub(new DateInterval("P2D"));
		//echo "hello sunday";
	} elseif ($weekday=="Monday") {
		$latestEndDate->sub(new DateInterval("P3D"));
		//echo "hello monday";
	} elseif ($weekday=="Tuesday") {
		$latestEndDate=new DateTime("now");
		//echo "hello tuesday";
	} elseif ($weekday=="Wednesday") {
		$latestEndDate->sub(new DateInterval("P1D"));
		//echo "hello Wednesday";
	} elseif ($weekday=="Thursday") {
		$latestEndDate->sub(new DateInterval("P2D"));
		//echo "hello Thursday";
	} elseif ($weekday=="Friday") {
		$latestEndDate=new DateTime("now");
		//echo "hello friday";
	} elseif ($weekday=="Saturday") {
		$latestEndDate->sub(new DateInterval("P1D"));
		//echo "hello Saturday";
	}

	$lastSaleEndDate = $latestEndDate->format("Y-m-d");

	if (Request::ajax()) {

		$champ_sales = ChampSales::where('start_date', '=', $lastSaleEndDate)->orderBy("sale_price", "desc")->take(3)->get();
		$skin_sales = SkinSales::where('start_date', '=', $lastSaleEndDate)->orderBy("sale_price", "desc")->take(3)->get();

		return View::make('saleContent')->with('champ_sales', $champ_sales)->with('skin_sales', $skin_sales);
	}
});

Route::get('/header3', function(){
	
	$today = new DateTime("now");
	$weekday=$today->format("l");


	if ($weekday=="Thursday") {
		$today->add(new DateInterval("P1D"));
	} else {
		$today->add(new DateInterval("P1D"));
	}

	$nextSaleEndDate = $today->format("Y-m-d");

	//echo $nextSaleEndDate;

	if (Request::ajax()) {

		$champ_sales = ChampSales::where('start_date', '=', $nextSaleEndDate)->orderBy("sale_price", "desc")->take(3)->get();
		$skin_sales = SkinSales::where('start_date', '=', $nextSaleEndDate)->orderBy("sale_price", "desc")->take(3)->get();

		return View::make('saleContent')->with('champ_sales', $champ_sales)->with('skin_sales', $skin_sales);
	}
});











