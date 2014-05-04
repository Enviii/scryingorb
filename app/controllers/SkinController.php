<?php 

class SkinController extends BaseController {

	public function getSkins() {

		//echo $skin_set = Skin::find(1)->skin_set;
		//echo $skin_set = Skin::find(1)->skin_set;

		$skins = Skin::get();

		// foreach ($skins as $skin)
		// {
		//     echo $skin->id." ".$skin->set." ".$skin->champion;
		//     echo "<br>";
		// }
		return View::make('skins.skins')->with('skins', $skins);
	}

	public function showSkin($id) {
		if (is_numeric($id)) {
			$skinModel=Skin::find($id);
		} else {
			$id=str_replace("_", " ", $id);
			$column='skin';
			$skins=Skin::where("skin", '=', $id)->get();
		}

		// return View::make('skins.single')->with('skin',$skinModel);
		//$skins=Skin::where("date_last_sale", '=', "2014-05-02")->get();
		//$skin = Skin::find(1)->skin_set;
		// echo $skin_set = Skin::find(1)->skin_set;
		//echo '<pre>', print_r($skin), '</pre>';

		return View::make('skins.single')->with('skins', $skins);
	}
}
