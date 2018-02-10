<?php
namespace app\index\controller;
use think\Controller;


class User extends Controller{
    public function login(){
    	return $this->fetch();
    	
    }
    public function register(){
    	if(request()->isPost()){
    		$data = input('post.');
    		if(!captcha_check($data['verifycode'])){
    			$this->error('验证码错误');
    		}
    		$judge = model('User')->get(['username'=>$data['username']]);
    		if(!empty($judge)){
    			$this->error('用户名已存在');
    		}
    		if($data['password'] != $data['repassword']){
    			$this->error('前后密码不一致');
    		}
    		$data['code'] = mt_rand(100,10000);
    		$userData = [
    			'username' => $data['username'],
    			'password' => md5($data['password'].$data['code']),
    			'code' => $data['code'],
    			'email' => $data['email'],
    			'status' => 1,
    		];

    		$id = model('User')->add($userData);
    		if(!empty($id)){
    			$this->success('注册成功','user/login');
    		}

    	}
    	else{
    		return $this->fetch();
    	}
    }
}
