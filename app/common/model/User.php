<?php
namespace app\common\model;
use think\Model;


class User extends BaseModel{
	public function add($data=[]){
		$data['status'] = 1;
		$id = $this->save($data);
		return $id;
	}

	public function test(){
		return 'yes';
	}
}