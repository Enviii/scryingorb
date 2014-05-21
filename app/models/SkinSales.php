<?php
class SkinSales extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'skin_sales';

	public function skinBelongsTo(){
		return $this->belongsTo('Skin', 'skin_id', 'id');
	}
}
