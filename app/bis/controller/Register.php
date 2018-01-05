<?php
namespace app\bis\controller;
use think\Controller;

class Register extends Controller{

	private $obj;

	public function _initialize(){
		$this->obj = model('City');
	}
	public function index(){
		$cities = $this->obj->getNormalCitiesByParentId();
		return $this->fetch('',['cities'=>$cities]);
	}

}
