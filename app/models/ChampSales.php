<?php

class ChampSales extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'champ_sales';

	public function champ(){
		return $this->belongsTo('Champion', 'champion_id', 'id');
	}

}
