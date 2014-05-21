<?php 

class SkinController extends BaseController {

	public function getSkins() {

		$skins = Skin::all();

		$skin = Skin::all();
		foreach ($skin as $s) {

		}
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

		return View::make('skins.single')->with('skins', $skins);
	}
}
