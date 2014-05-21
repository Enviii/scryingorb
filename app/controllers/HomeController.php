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

	public function home() {
		date_default_timezone_set('America/New_York');

/*		$today = new DateTime("now");
		$today = $today->format("Y-m-d");*/

		//$testing ="test";

/*		$champ_sales2 = Champion::with('championOnSale')->get();

		foreach ($champ_sales2 as $key => $value) {
			//echo $value->champion;
			foreach ($value->championOnSale as $value2) {
				//echo " - ".$value2->start_date;
			}
			//echo "<br>";
		}*/

		//$champsales = ChampSales::find(2);
		//echo "somewhere ".$champsales->champ->last_sale;


		$champ_sales = ChampSales::whereRaw('CURDATE() between start_date and end_date')->take(3)->get();
		$skin_sales = SkinSales::whereRaw('CURDATE() between start_date and end_date')->take(3)->get();


		$champions=Champion::all();
		$skins=Skin::all();

		$championArray=array();
		$skinArray=array();

		foreach ($champions as $key => $value) {
			//echo $value->champion."<br>";
			$championArray[]=$value->champion;
		}

		foreach ($skins as $key => $value) {
			$skinArray[]=$value->skin;
		}

		//echo "<pre>";
		//print_r($championArray);
		//echo "</pre>";

		$json = json_encode($championArray);
		$json2 = json_encode($skinArray);
		//$json = str_replace('"', '', $json);

		//echo $json;


		//$skinsales=SkinSales::find(2);

		//echo $skinsales->skinBelongsTo->date_last_sale;

		//echo $result;

		//$champ_sales = ChampSales::orderBy('start_date', 'desc')->take(3)->get();
		//$skin_sales=SkinSales::orderBy('start_date', 'desc')->take(3)->get();

/*		foreach (ChampSales::all() as $book)
		{
		    //echo $book->champ->champion;
		    echo $book->start_date;
		    echo "<br>";

		}*/

		return View::make('home')->with('champ_sales', $champ_sales)->with('skin_sales', $skin_sales)->with('champions',$json)->with('skins',$json2);
	}

}
