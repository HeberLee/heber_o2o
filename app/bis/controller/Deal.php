<?php
namespace app\bis\controller;
use think\Controller;

class Deal extends Controller{

	public function _initialize(){
		$this->city_obj = model('City');
		$this->category_obj = model('Category');
		$this->bis_location_obj = model('BisLocation');
	}

	public function index(){
		return $this->fetch();
	}

	public function add(){
		$data = session('bisAccount','','bis');
		$bis_id = $data['bis_id'];
		$cities = $this->city_obj->getNormalCitiesByParentId();
		$categorys = $this->category_obj->getNormalFirstCategorys();
		$bisLocations = $this->bis_location_obj->getLocationsByBisId($bis_id);
		return $this->fetch('',['cities'=>$cities,'categorys'=>$categorys,'bisLocations'=>$bisLocations]);
	}

}
