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
			foreach ($champions as $key => $value) {
				$valueIP = $value->ip."<br>";
				if ($valueIP==3150 || $valueIP==1350) {
					$count3150 = Champion::where('ip', '=', '3150')->count();
					$count1350 = Champion::where('ip', '=', '1350')->count();
					$countComb = $count3150+$count1350;
					$countIP = $countComb;
				} else {
					$countIP = Champion::where('ip', '=', $value->ip)->count();
				}
			}
			$countChamp = Champion::where('status', '=', '3')->count();
		}

		return View::make('champions.singleChampion')->with('champions', $champions)->with('countIP', $countIP)->with('countChamp', $countChamp);
	}
}