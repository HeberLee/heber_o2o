<?php
namespace app\common\model;
use think\Model;
use think\Request;

class BaseModel extends Model{
	protected $autoWriteTimestamp = true;

	public function add($data){
		$data['status'] = 0;
		$id = $this->save($data);
		return $id;
	}



}