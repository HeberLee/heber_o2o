<?php
namespace app\common\model;
use think\Model;
use think\Request;

class User extends Model{
	protected $autoWriteTimestamp = true;

	// public function getIdenticalUsername($username){
	// 	// $data[
	// 	// 	'username' => $username,
	// 	// ];
	// 	// $this->where($data)
	// 	// 	->select();
	// 	return $judge = $this->get(,['username'=>$username]);
	// }
	public function add($data){
		$id = $this->save($data);
		return $id;
	}


}