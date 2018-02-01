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
		$session_data = session('bisAccount','','bis');
		$bis_id = $session_data['bis_id'];
		$deals = model('deal')->getDealsByBisId($bis_id);
		return $this->fetch('',['deals'=>$deals]);
	}

	public function add(){
		$session_data = session('bisAccount','','bis');
		$bis_id = $session_data['bis_id'];

		if(request()->isPost()){
			$data = input('post.');

			//校验步骤在此省略
			// dump($data['se_category_id']);
			// $test = empty($data['se_category_id'])?'':implode(',', $data['se_category_id']);
			// dump($test);
			$deals = [

				'bis_id' => $bis_id,
				'name' => $data['name'],
				'image' => $data['image'],
				'category_id' => $data['category_id'],
				'se_category_id' => empty($data['se_category_id'])?'':implode(',', $data['se_category_id']),
				'city_id' => $data['city_id'],
				'location_ids' => empty($data['location_ids'])?'':implode(',', $data['location_ids']),
				'start_time' =>strtotime($data['start_time']),
				'end_time' => strtotime($data['end_time']),
				'total_count' => $data['total_count'],
				'current_price' => $data['current_price'],
				'origin_price' => $data['origin_price'],
				'coupons_begin_time' => strtotime($data['coupons_begin_time']),
				'coupons_end_time' => strtotime($data['coupons_end_time']),
				'notes' => $data['notes'],
				'description' => $data['description'],
				'bis_account_id' => $session_data['id'],
			];
			$id = model('deal')->add($deals);

			if($id){
				$this->success('添加成功',url('deal/index'));
			}
			else{
				$this->error('添加失败');
			}

		}
		else{
			$cities = $this->city_obj->getNormalCitiesByParentId();
			$categorys = $this->category_obj->getNormalFirstCategorys();
			$bisLocations = $this->bis_location_obj->getLocationsByBisId($bis_id);
			return $this->fetch('',['cities'=>$cities,'categorys'=>$categorys,'bisLocations'=>$bisLocations]);
		}
		
	}

}
