<?php
namespace app\common\model;
use think\Model;
use think\Request;

class BisLocation extends BaseModel{
	public function getLocationsByBisId($bis_id){

		$data = [
			// 'parent_id' => 0,
			'bis_id'=> $bis_id,
		];
		$order = [
			'create_time' => 'desc',
		];
		return $this->where($data)
					->order($order)
					->paginate(5);
	}

	public function getLocations(){

		$data = [
			'status' => 1,
		];
		$order = [
			'create_time' => 'desc',
		];
		return $this->where($data)
					->order($order)
					->select();
	}

	public function getApplyLocations(){

		$data = [
			'status' => 0,
		];
		$order = [
			'create_time' => 'desc',
		];
		return $this->where($data)
					->order($order)
					->select();
	}

}