<?php
namespace app\bis\controller;
use think\Controller;

class Register extends Controller{

	private $city_obj;
	private $category_obj;

	public function _initialize(){
		$this->city_obj = model('City');
		$this->category_obj = model('Category');
	}
	public function index(){
		$cities = $this->city_obj->getNormalCitiesByParentId();
		$categorys = $this->category_obj->getNormalFirstCategorys();
 		return $this->fetch('',['cities'=>$cities,'categorys'=>$categorys]);
	}

}
