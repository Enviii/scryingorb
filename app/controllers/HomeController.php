<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	// public function showWelcome()
	// {
	// 	return View::make('hello');
	// }

	public function home() {

		//$skins=Skin::get();
		//$champ_sales=ChampSales::get();



		$champ_sales = ChampSales::orderBy('start_date', 'desc')->take(3)->get();
		$skin_sales=SkinSales::orderBy('start_date', 'desc')->take(3)->get();
		//$champ_sales=ChampSales::where("start_date", '=', "2014-05-02")->get();
		//$skin_sales=SkinSales::where("start_date", "=", "2014-05-02")->get();
		//$skin = Skin::find(1)->skin_set;
		// echo $skin_set = Skin::find(1)->skin_set;
		//echo '<pre>', print_r($skin), '</pre>';

		return View::make('home')->with('champ_sales', $champ_sales)->with('skin_sales', $skin_sales);
	}

}
