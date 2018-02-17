<?php
namespace app\common\model;
use think\Model;
use think\Request;

class Deal extends BaseModel{
	public function getDealsByBisId($bis_id=0){
		$data = [
			'bis_id' => $bis_id,
			'status' => 1,
		];
		$order = [
			'id' => 'desc',
		];
		return $this->where($data)
					->order($order)
					->select();
	}

	public function getNormalDeals($data=[]){
		$data['status'] = 1;
		$order = [
			'id' => 'desc',
		];
		return $this->where($data)
					->order($order)
					->select();
	}

/**
 * @Author   HeberLee
 * @DateTime 2018-02-17T22:05:33+0800
 * @param    [type]                   $city_id     [城市id作为条件之一来获取团购]
 * @param    [type]                   $category_id [分类id]
 * @param    integer                  $limit       [约束条数]
 * @return   [type]
 */
	public function getDealsByCityId($city_id,$category_id,$limit=10){
		$data = [
			'end_time' => ['gt',time()],
			'city_id' => $city_id,
			'category_id' => $category_id,
			'status' => 1,
		];
		$order = [
			'listorder' => 'asc',
			'id' => 'desc',
		];
		$result = $this->where($data)
					->order($order);
		if($limit){
			$result = $result->limit($limit);
		}
		return $result->select();

	}
}