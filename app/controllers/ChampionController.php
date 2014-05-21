<?php 

class ChampionController extends BaseController {

	public function getChampions() {
		$champions = Champion::with('skins')->get();
		$champ_id=Champion::find(3)->skin;
		$champ = Champion::find(2);

		return View::make('champions.champions')->with('champions', $champions);
	}

	public function showChampion($name) {
		if (is_numeric($name)) {
			$champions=Champion::find($name);
		} else {
			$champions=Champion::where("champion", '=', $name)->get();
		}

		return View::make('champions.singleChampion')->with('champions', $champions);
	}
}