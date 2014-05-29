<?php 

class SkinHistoryController extends BaseController {

	public function showSkinHistory() {

		$distinctRP = Skin::distinct()->orderBy('rp', 'desc')->get(array('rp'));
		$countSkin = Skin::all();
		$countSkin = count($countSkin);

		foreach ($distinctRP as $key => $value) {
			//echo $value."<br>";
			# code...
		}

		$rp1820 = Skin::where('rp', '=', '1820')->orderBy("date_last_sale", "asc")->get();
		$rp1350 = Skin::where('rp', '=', '1350')->orderBy("date_last_sale", "asc")->get();
		$rp975 = Skin::where('rp', '=', '975')->orderBy("date_last_sale", "asc")->get();
		$rp750 = Skin::where('rp', '=', '750')->orderBy("date_last_sale", "asc")->get();
		$rp520 = Skin::where('rp', '=', '520')->orderBy("date_last_sale", "asc")->get();
		$rp390 = Skin::where('rp', '=', '390')->orderBy("date_last_sale", "asc")->get();

/*		$count1820 = count($rp1820);
		$count1350 = count($rp1350);
		$count975 = count($rp975);
		$count750 = count($rp750);
		$count520 = count($rp520);
		$count390 = count($rp390);*/

		/*		->with('count1820',$count1820)
		->with('count1350',$count1350)
		->with('count975',$count975)
		->with('count750',$count750)
		->with('count520',$count520)
		->with('count390',$count390)*/


		//$Skins=Skin::with('skins')->get();
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
}