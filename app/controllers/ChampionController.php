<?php 

class ChampionController extends BaseController {

	public function getChampions() {
		$champions = Champion::with('skins')->orderBy("champion", "asc")->get();
/*		$champ_id=Champion::find(3)->skin;
		$champ = Champion::find(2);*/

/*		$queries = DB::getQueryLog();
		$last_query = end($queries);

		echo "<pre>";
		print_r($queries);
		echo "</pre>";*/

		return View::make('champions.champions')->with('champions', $champions);
	}

	public function showChampion($name) {
		if (is_numeric($name)) {
			//$champions=Champion::find($name);
		} else {
			$champions=Champion::with('skins')->where("champion", '=', $name)->get();
		}

		return View::make('champions.singleChampion')->with('champions', $champions);
	}
}