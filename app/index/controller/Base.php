<?php
namespace app\index\controller;
use think\Controller;


class Base extends Controller{
	private $city;
	private $userInfo;

	public function _initialize(){
		$cities = model('City')->getNormalCities();
		$this->getCity($cities);
		$this->getUserInfo();
		$this->assign('cities',$cities);
		$this->assign('city',$this->city);
		$this->assign('userInfo',$this->userInfo);
	}

	public function getCity($cities){
		foreach ($cities as $city) {
			$city = $city->toArray();
			if($city['is_default'] == 1){
				$defaultuname = $city['uname'];
				break;
			}
		}

		$defaultuname = !empty($defaultuname)?$defaultuname:'quanzhou';

		if(session('cityuname','','o2o') && !input('get.city')){
			$cityuname = session('cityuname','','o2o');
		}
		else{
			$cityuname = input('get.city',$defaultuname,'trim');
			session('cityuname',$cityuname,'o2o');
		}

		$this->city = model('City')->get(['uname'=>$cityuname]);

		
	}
	public function getUserInfo(){
		if(empty($this->userInfo)){
			$this->userInfo = session('user','','o2o');
		}

		
	}
    // public function index(){
    // 	return $this->fetch();
    // }

    // public function test(){
    // 	return \Map::getLngLat('泉州华侨大学');
    // }

    // public function map(){
    // 	return \Map::getStaticImage('泉州华侨大学');
    // }

}
