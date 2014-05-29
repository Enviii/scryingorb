<?php 

class HistoryController extends BaseController {

	public function showHistory() {

		$distinctRP = Champion::distinct()->orderBy('ip', 'desc')->get(array('ip'));
		$countChamp = Champion::where('status', '=', '3')->count();

		//remove 450 ip champions
		unset($distinctRP[4]);

		//get ip champions
		$ip6300 = Champion::where('ip', '=', '6300')->orderBy("last_sale", "asc")->get();
		$ip4800 = Champion::where('ip', '=', '4800')->orderBy("last_sale", "asc")->get();
		$ip3150 = Champion::where('ip', '=', '3150')->orderBy("last_sale", "asc")->get();
		$ip1350 = Champion::where('ip', '=', '1350')->orderBy("last_sale", "asc")->get();
		$ip450 = Champion::where('ip', '=', '450')->orderBy("last_sale", "asc")->get();

		//echo count($ip1350);
		$countip6300 = count($ip6300);
		$countip4800 = count($ip4800);
		$countip450 = count($ip450);

		//combine 3150 and 1350
		$countComb = count($ip3150)+count($ip1350);
		$countip3150 = $countComb;
		$countip1350 = $countComb;


		//count amount of champions in ip set
/*		$countip6300 = Champion::where('ip', '=', '6300')->count();
		$countip4800 = Champion::where('ip', '=', '4800')->count();
		$countip3150 = Champion::where('ip', '=', '3150')->count();
		$countip1350 = Champion::where('ip', '=', '1350')->count();*/

/*		echo $countip1350;

		//combine 3150 and 1350 champions into 1 set
		$countComb = $countip3150+$countip1350;

		//set 3150 and 1350 to combined value
		$countip3150 = $countComb;
		$countip1350 = $countComb;*/

		return View::make('history')->with('ip6300', $ip6300)->with('ip4800', $ip4800)->with('ip3150', $ip3150)->with('ip1350', $ip1350)->with('ip450', $ip450)->with("ip_range", $distinctRP)->with('count6300', $countip6300)->with('count4800', $countip4800)->with('count3150', $countip3150)->with('count1350', $countip1350)->with('countChamp',$countChamp);
	}

}