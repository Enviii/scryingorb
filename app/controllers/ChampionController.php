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

		/**
		 * Calculates the number of days past since the last sale.
		 *
		 * @param  last_sale_db 		DB value of champions last_sale
		 * @param  sale_start_date_db  	DB value of champions sale_start_date
		 * @param  sale_end_date_db  	DB value of champions sale_end_date
		 * @param  today			  	Todays date in DateTime obj
		 * @param  day3 			  	Date of 3 days ago in DateTime obj
		 * @return date in Y-m-d.
		 */ 
		function saleInterval($last_sale_db, $sale_start_date_db, $sale_end_date_db, $today, $day3){
			$interval=null;
			$onSaleNow=null;
			$onNextSale=null;
			$soon=null;
			$justPassed=null;

			/*Check if date column is null before assigning DateTime obj*/
			if ($last_sale_db==null) {
				$last_sale=null;
			} else {
				$last_sale = new DateTime($last_sale_db);
			}

			if ($sale_start_date_db==null) {
				$sale_start_date=null;
			} else {
				$sale_start_date = new DateTime($sale_start_date_db);
				$sale_start_date_format = $sale_start_date->format("Y-m-d");
			}

			if ($sale_end_date_db==null) {
				$sale_end_date=null;
			} else {
				$sale_end_date = new DateTime($sale_end_date_db);
				$sale_end_date_format = $sale_end_date->format("Y-m-d");
			}
			

			/*calculate days since the sale ended*/
			//check if sale_start_date OR sale_end_date is null
			if ($sale_start_date==null || $sale_end_date==null) {
				//use last_sale for days past
				$interval = $last_sale->diff($today);
				$interval = $interval->format('%a days');
				return $interval;
			} elseif ($sale_start_date<=$today && $sale_end_date>=$today) {
				//if today is between start and end date
				//$onSaleNow=true;
				$interval = $sale_start_date->diff($today);
				$interval = $interval->format('%a days');
				return $interval;
			} elseif ($sale_start_date>$today || $sale_end_date > $day3 ) {
				//$onNextSale=true;
				$interval = $last_sale->diff($today);
				$interval = $interval->format('%a days');
				return $interval;
			} else {
				$interval = $last_sale->diff($today);
				$interval = $interval->format('%a days');
				return $interval;
			}
		}

		/**
		 * Calculates the estimated sale date
		 *
		 * @param  last_sale_db 		DB value of champions last_sale
		 * @param  sale_start_date_db  	DB value of champions sale_start_date
		 * @param  sale_end_date_db  	DB value of champions sale_end_date
		 * @param  rp 				  	DB value of champions rp
		 * @param  today			  	Todays date in DateTime obj
		 * @param  day3 			  	Date of 3 days ago in DateTime obj
		 * @param  countChamp 		  	Total champion count
		 * @return string that classifies what status it is. Ex. soon, now, next, or neither (date).
		 */ 
		function saleDate($last_sale_db, $sale_start_date_db, $sale_end_date_db, $rp, $today, $day3, $countChamp){
			$interval=null;
			$onSaleNow=null;
			$onNextSale=null;
			$soon=null;
			$justPassed=null;

			/*Check if date column is null before assigning DateTime obj*/
			if ($last_sale_db==null) {
				$last_sale=null;
			} else {
				$last_sale = new DateTime($last_sale_db);
			}

			if ($sale_start_date_db==null) {
				$sale_start_date=null;
			} else {
				$sale_start_date = new DateTime($sale_start_date_db);
				$sale_start_date_format = $sale_start_date->format("Y-m-d");
			}

			if ($sale_end_date_db==null) {
				$sale_end_date=null;
			} else {
				$sale_end_date = new DateTime($sale_end_date_db);
				$sale_end_date_format = $sale_end_date->format("Y-m-d");
			}
			

			/*calculate days since the sale ended*/
			//check if sale_start_date OR sale_end_date is null
			if ($sale_start_date==null || $sale_end_date==null) {
				//use last_sale for days past
				$interval = $last_sale->diff($today);
				$interval = $interval->format('%a days');

				//prediction formula
				$formula = $rp*(365/$countChamp);
				$days = round($formula);

				//calculate estimated date:
				$expected_sale_date = $last_sale->add(new DateInterval('P'.$days.'D'));

				if ($expected_sale_date<=$today) {
					//$soon = true;
					return "soon";
				} else {
					$expected_sale_date_format = $expected_sale_date->format("M d \'y");
					return $expected_sale_date_format;
				}

			} elseif ($sale_start_date<=$today && $sale_end_date>=$today) {
				//if today is between start and end date
				//$onSaleNow=true;
				$interval = $sale_start_date->diff($today);
				$interval = $interval->format('%a days');
				return "onSaleNow";
			} elseif ($sale_start_date>$today) {
				//$onNextSale=true;
				$interval = $last_sale->diff($today);
				$interval = $interval->format('%a days');
				return "onNextSale";
			} elseif ($sale_end_date > $day3) {
				//$justPassed=true;
				$interval = $last_sale->diff($today);
				$interval = $interval->format('%a days');
				return "justPassed";
			} else {
				$formula = $rp*(365/$countChamp);
				$days = round($formula);
				$expected_sale_date = $last_sale->add(new DateInterval('P'.$days.'D'));

				$expected_sale_date_format = $expected_sale_date->format("M d \'y");
				return $expected_sale_date_format;
			}
		}

		return View::make('champions.singleChampion')->with('champions', $champions)->with('countIP', $countIP)->with('countChamp', $countChamp);
	}
}