<?php

class Skin extends Eloquent {

	protected $table = 'skins';

	public function champion() {
		return $this->belongsTo('Champion', 'champion_id', 'id');
	}
}
