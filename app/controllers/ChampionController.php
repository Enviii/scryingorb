<?php 

class ChampionController extends BaseController {

	public function getChampions() {
		//$champions = Champion::get();
		$champions = Champion::with('skins')->get();

		$champ_id=Champion::find(3)->skin;
		//$champ = Champion::find(2);
		$champ = Champion::find(2);

	// foreach ($champ->skin as $c) {
	// 	echo $c->set."<br>";
	// }

	// $skin = Skin::all();
	// foreach ($skin as $s) {
	// 	echo $s->champion->champion;
	// 	echo $s->champion;
	// }

		return View::make('champions.champions')->with('champions', $champions);
	}

	public function showChampion($name) {
		if (is_numeric($name)) {
			$champions=Champion::find($name);
		} else {
			//$id=str_replace("_", " ", $name);
			//$column='skin';
			$champions=Champion::where("champion", '=', $name)->get();
		}

		// return View::make('skins.single')->with('skin',$skinModel);
		//$skins=Skin::where("date_last_sale", '=', "2014-05-02")->get();
		//$skin = Skin::find(1)->skin_set;
		// echo $skin_set = Skin::find(1)->skin_set;
		//echo '<pre>', print_r($skin), '</pre>';

		return View::make('champions.singleChampion')->with('champions', $champions);
	}
}