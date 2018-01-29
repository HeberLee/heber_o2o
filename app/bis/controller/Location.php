<?php
namespace app\bis\controller;
use think\Controller;


class Location extends Base{

	public function _initialize(){
		$this->city_obj = model('City');
		$this->category_obj = model('Category');
	}

	public function index(){
		$data = session('bisAccount','','bis');
		$bis_id = $data['bis_id'];
		$locations = model('BisLocation')->getLocationsByBisId($bis_id);
		// dump($locations);
		if($locations){
			return $this->fetch('',['locations' => $locations]);
		}
		else{
			return $this->error('');
		}
	}

	public function add(){
		$cities = $this->city_obj->getNormalCitiesByParentId();
		$categorys = $this->category_obj->getNormalFirstCategorys();
		return $this->fetch('',['cities'=>$cities,'categorys'=>$categorys]);
	}

	public function detail(){

	}
}
