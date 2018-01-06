<?php
namespace app\common\model;
use think\Model;
use think\Request;

class City extends Model{
	protected $autoWriteTimestamp = true;

	public function getNormalCitiesByParentId($parent_id=0){
		$data = [
			'parent_id' => $parent_id,
			'status' => 1,
		];
		$order = [
			'id' => 'desc',
		];
		return $this->where($data)
					->order($order)
					->select();
	}

	public function ins(){

		$this->saveAll([
			['name' => '浙江',
			'uname' => 'zhejiang'],
			['name' => '杭州',
			'uname' => 'hangzhou'],
			['name' => '福建',
			'uname' => 'fujian'],
			['name' => '泉州',
			'uname' => 'quanzhou'],
			['name' => '福州',
			'uname' => 'fuzhou'],
		]);
	}


}