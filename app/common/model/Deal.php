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
}