<?php
namespace app\common\model;
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

	public function getCategorysByParentId($parent_id){
		$data = [
			'parent_id' => $parent_id,
			'status' => ['neq','-1'],
		];
		$order = [
			'listorder' => 'asc',
		];
		return $this->where($data)
					->order($order)
					->paginate(5);
	}

	public function getCategorysByParentIdNoPages($parent_id){
		$data = [
			'parent_id' => $parent_id,
			'status' => ['neq','-1'],
		];
		$order = [
			'listorder' => 'asc',
		];
		return $this->where($data)
					->order($order)
					->select();
	}

	public function getNormalRecommendCategorysByParentId($parent_id=0,$limit=5){
		$data = [
			'parent_id' => $parent_id,
			'status' => 1,
		];
		$order = [
			'listorder' => 'dsc',
			'id' => 'dsc',
		];
		$result = $this->where($data)
					->order($order);

		if($limit){
			$result = $result->limit($limit);
		}
		return $result->select();
	}

	public function getNormalCategorysByParentId($ids){
		$data = [
			'parent_id' => ['in',implode(',',$ids)],
			'status' => 1,
		];
		$order = [
			'listorder' => 'dsc',
			'id' => 'dsc',
		];
		$result = $this->where($data)
					->order($order)
					->select();
		return $result;
	}

	// public function getNameById($id){
	// 	$data = [
	// 		'id' => $id,
	// 	];
	// 	return $this->where($data);
	// }
}