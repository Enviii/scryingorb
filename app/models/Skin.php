<?php

class Skin extends Eloquent {

	protected $table = 'skins';

	public function champion() {
		return $this->belongsTo('Champion');
	}

	public function skinsales() {
		return $this->hasMany('SkinSales');
	}

}
