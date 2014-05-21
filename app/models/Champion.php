<?php

class Champion extends Eloquent {

	protected $table = 'champions';

	public function skins(){
		return $this->hasMany('Skin');
	}

	public function championOnSale(){
		return $this->hasMany('ChampSales');
	}

	public function skinOnSale(){
		return $this->hasMany('SkinSales');
	}

}
