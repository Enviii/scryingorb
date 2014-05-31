<?php 

class SkinHistoryController extends BaseController {

	public function showSkinHistory() {

		$distinctRP = Skin::distinct()->orderBy('rp', 'desc')->get(array('rp'));
		$countSkin = Skin::all();
		$countSkin = count($countSkin);

		$rp1820 = Skin::where('rp', '=', '1820')->orderBy("date_last_sale", "asc")->get();
		$rp1350 = Skin::where('rp', '=', '1350')->orderBy("date_last_sale", "asc")->get();
		$rp975 = Skin::where('rp', '=', '975')->orderBy("date_last_sale", "asc")->get();
		$rp750 = Skin::where('rp', '=', '750')->orderBy("date_last_sale", "asc")->get();
		$rp520 = Skin::where('rp', '=', '520')->orderBy("date_last_sale", "asc")->get();
		$rp390 = Skin::where('rp', '=', '390')->orderBy("date_last_sale", "asc")->get();

		$skins = Skin::all();

		return View::make('skinhistory')->with('skins', $skins)
		->with('rp1820',$rp1820)
		->with('rp1350',$rp1350)
		->with('rp975',$rp975)
		->with('rp750',$rp750)
		->with('rp520',$rp520)
		->with('rp390',$rp390)
		->with('rp_range', $distinctRP)
		->with('countSkin',$countSkin);
	}

	public function specificRP($rp) {

		if (Request::ajax()) {

			$rpSpecific = Skin::where('rp', '=', $rp)->orderBy("date_last_sale", "asc")->get();
			$countSkin = Skin::count();
			//$countSkin = count($countSkin);

/*			$queries = DB::getQueryLog();
			echo "<pre>";
			print_r($queries);
			echo "</pre>";
			$last_query = end($queries);*/

			return View::make('specificRP')->with('rpSpecific', $rpSpecific)->with('countSkin',$countSkin);;
		}

	}
}