<?php
namespace app\common\model;
use think\Model;
use think\Request;

class Featured extends BaseModel{
	public function getFeaturedsByType($type){
		$data = [
			'type' => $type,
			'status' => ['neq',-1],
		];
		$order = [
			'id' => 'desc',
		];
		return $this->where($data)
				->order($order)
				->select();
	}
}