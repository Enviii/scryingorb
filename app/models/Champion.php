<?php

class Champion extends Eloquent {

	protected $table = 'champions';

	public function skins(){
		return $this->hasMany('Skin');
	}

}
