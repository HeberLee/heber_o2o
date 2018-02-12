<?php
namespace app\index\controller;
use think\Controller;


class User extends Controller{
    public function index(){
        return 'success';
    }

    public function login(){
        if(request()->isPost()){
            $data = input('post.');
            if(!captcha_check($data['verifycode'])){
                $this->error('验证码错误');
            }
            $userData = model('User')->get(['username'=>$data['username']]);
            if(empty($userData)){
                $this->error('该用户不存在');
            }
            if($userData['password'] != md5($data['password'].$userData['code'])){
                $this->error('密码错误');
            }
            session('user',$userData,'o2o');
            $this->success('登录成功','index/index');

        }
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
            else{
                $this->error('注册失败');
            }

    	}
    	else{
    		return $this->fetch();
    	}
    }

    public function logout(){
        session(null,'o2o');
        $this->redirect(url('user/login'));
    }
}
