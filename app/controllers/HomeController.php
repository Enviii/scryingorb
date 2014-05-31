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

/*		$champions=Champion::all();
		$skins=Skin::all();

		$championArray=array();
		$skinArray=array();

		foreach ($champions as $key => $value) {
			$championArray[]=$value->champion;
		}

		foreach ($skins as $key => $value) {
			$skinArray[]=$value->skin;
		}

		$json = json_encode($championArray);
		$json2 = json_encode($skinArray);

		echo $json."<br><br>";
		echo $json2."<br><br>";*/

		$today = new DateTime("now");
		$latestEndDate=new DateTime("now");
		$latestStartDate=new DateTime("now");
		$weekday=$today->format("l");
		//echo $weekday;

		if ($weekday=="Sunday") {
			$latestStartDate->sub(new DateInterval("P2D"));
			$latestEndDate->sub(new DateInterval("P2D"));
			//echo "hello sunday";
		} elseif ($weekday=="Monday") {
			$latestStartDate->sub(new DateInterval("P3D"));
			$latestEndDate->sub(new DateInterval("P3D"));
			//echo "hello monday";
		} elseif ($weekday=="Tuesday") {
			$latestStartDate=new DateTime("now");
			$latestEndDate->sub(new DateInterval("P1D"));
			//echo "hello tuesday";
		} elseif ($weekday=="Wednesday") {
			$latestStartDate->sub(new DateInterval("P1D"));
			$latestEndDate->sub(new DateInterval("P2D"));
			//echo "hello Wednesday";
		} elseif ($weekday=="Thursday") {
			$latestStartDate->sub(new DateInterval("P2D"));
			$latestEndDate->sub(new DateInterval("P3D"));
			//echo "hello Thursday";
		} elseif ($weekday=="Friday") {
			$latestStartDate=new DateTime("now");
			$latestEndDate=new DateTime("now");
			//echo "hello friday";
		} elseif ($weekday=="Saturday") {
			$latestStartDate->sub(new DateInterval("P1D"));
			$latestEndDate->sub(new DateInterval("P1D"));
			//echo "hello Saturday";
		}

		$lastSaleEndDate = $latestEndDate->format("Y-m-d");
		$lastSaleStartDate = $latestStartDate->format("Y-m-d");

		$champ_sales = ChampSales::where('start_date', '=', $lastSaleStartDate)->orderBy("sale_price", "desc")->take(3)->get();
		$skin_sales = SkinSales::where('start_date', '=', $lastSaleStartDate)->orderBy("sale_price", "desc")->take(3)->get();

		$old_champ_sale = ChampSales::where('end_date', '=', $lastSaleEndDate)->orderBy("sale_price", "desc")->take(3)->get();
		$old_skin_sale = SkinSales::where('end_date', '=', $lastSaleEndDate)->orderBy("sale_price", "desc")->take(3)->get();

		//echo $old_champ_sale;

		/*$champ_sales = ChampSales::whereRaw('CURDATE() between start_date and end_date')->orderBy("sale_price", "asc")->take(3)->get();
		$skin_sales = SkinSales::whereRaw('CURDATE() between start_date and end_date')->orderBy("sale_price", "asc")->take(3)->get();*/

		return View::make('home')->with('champ_sales', $champ_sales)->with('skin_sales', $skin_sales)->with('old_skin_sale', $old_skin_sale)->with('old_champ_sale', $old_champ_sale);
	}

}
