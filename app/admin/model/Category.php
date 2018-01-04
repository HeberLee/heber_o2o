<?php
namespace app\admin\model;
use think\Model;
use think\Request;

class Category extends Model{
	protected $autoWriteTimestamp = true;

	public function add($data){
		$data['status'] = 1;
		return $this->save($data);
	}

	public function getNormalFirstCategorys(){
		$data = [
			'parent_id' => 0,
			'status' => 1,
		];
		$order = [
			'id' => 'desc',
		];
		return $this->where($data)
					->order($order)
					->select();
	}

	public function getCategorys($parent_id){
		$data = [
			'parent_id' => $parent_id,
			'status' => ['neq','-1'],
		];
		$order = [
			'listorder' => 'asc',
		];
		return $this->where($data)
					->order($order)
					->paginate();
	}
}