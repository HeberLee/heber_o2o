<?php
namespace app\bis\controller;
use think\Controller;
use think\session;

class Index extends Base{
	public function index(){
		return $this->fetch();
	}


}
