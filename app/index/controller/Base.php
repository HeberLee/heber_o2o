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
		//

		$cats = $this->getRecommendCats();
		$this->assign('cities',$cities);
		$this->assign('city',$this->city);
		$this->assign('userInfo',$this->userInfo);
		$this->assign('cats',$cats);
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

	public function getRecommendCats(){
		$parentIds = $seCatArr = $recommendCats = [];
		$cats = model('Category')->getNormalRecommendCategorysByParentId(0,5);
		foreach ($cats as $cat) {
			$parentIds[] = $cat['id'];
		}
		$seCats = model('Category')->getNormalCategorysByParentId($parentIds);
		foreach($seCats as $seCat){
			$seCatArr[$seCat['parend_id']] = [
				'id' => $seCat['id'],
				'name' => $seCat['name'],
			];
		}

		foreach($cats as $cat){
			$recommendCats[$cat['id']] = [$cat['name'],empty($seCatArr[$cat['id']])?'':$seCatArr[$cat['id']]];
		}

		return $recommendCats;
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
