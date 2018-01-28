<?php
namespace app\bis\controller;
use think\Controller;

class Base extends Controller{
	private $account;
	public function _initialize(){
		//判断用户是否已经登录
		$isLogin = $this->isLogin();
		if(!$isLogin){
			return $this->redirect(url('login/index'));
		}
		// $this->account = session('bisAccount','','');
		// if(!$this->account['id']){
		// 	return $this->redirect(url('login/index'));
		// }
	}

	public function isLogin(){
		$user = $this->getLoginUser();
		if($user && $user['id']){
			return true;
		}
		else{
			return false;
		}
	}

	public function getLoginUser(){
		// if(!$this->account){
			$this->account = session('bisAccount','','bis');
		// }
		return $this->account;

	}



}
