<?php
namespace app\bis\controller;
use think\Controller;


class Location extends Base{
	private $city_obj;
	private $category_obj;
	private $location_obj;

	public function _initialize(){
		$this->city_obj = model('City');
		$this->category_obj = model('Category');
		$this->location_obj = model('BisLocation');
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
		$data = input('get.');
		$cities = $this->city_obj->getNormalCitiesByParentId();
		$categorys = $this->category_obj->getNormalFirstCategorys();
		$tem = session('bisAccount','','bis');
		
		if(!empty($data)){
			$location_data = [
				'bis_id' => $tem['bis_id'],
				'name' => $data['name'],
				'logo' => $data['logo'],
				'category_id' => $data['category_id'],
				// 'se_category_id' => empty($data['se_category_id'])?'':implode(',', $data['se_category_id']),
				'city_id' => $data['city_id'],
				'address' => $data['address'],
				'contact' => $data['contact'],
				'tel' => $data['tel'],
				// 'location_ids' => empty($data['location_ids'])?'':implode(',', $data['location_ids']),
				// 'start_time' =>strtotime($data['start_time']),
				// 'end_time' => strtotime($data['end_time']),
				// 'total_count' => $data['total_count'],
				// 'current_price' => $data['current_price'],
				// 'origin_price' => $data['origin_price'],
				// 'coupons_begin_time' => strtotime($data['coupons_begin_time']),
				// 'coupons_end_time' => strtotime($data['coupons_end_time']),
				// 'notes' => $data['notes'],
				'content' => $data['content'],
				'is_main' => 0,
				// 'bis_account_id' => $session_data['id'],
			];
			$id = $this->location_obj->add($location_data);
			if(!empty($id)){
				return $this->success('申请新增门店成功','location/index');
			}
			
		}

		return $this->fetch('',['cities'=>$cities,'categorys'=>$categorys]);
	}

	public function detail(){

	}
}
