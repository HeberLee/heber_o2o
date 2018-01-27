<?php
namespace app\bis\controller;
use think\Controller;

class Login extends Controller{
	public function index(){
		if(request()->isPost()){
			$data = input('post.');
			$res = model('BisAccount')->get(['username'=>$data['username']]);
			if(!$res || $res->status!=1){
				$this->error('抱歉，用户不存在或尚未通过审核');
			}
			if($res->password != md5($data['password'].$res->code)){
				$this->error('抱歉，密码错误');
			}
			$res1 = model('BisAccount')->update(['last_login_time'=>time()],['username'=>$data['username']]);

			//在确认密码正确后将用户信息存入sessio中,第一个参数为session的名字，第二个为session内容，第三个为作用域
			session('bisAccount',$res,'bis');

			if($res1){
				return $this->success('登录成功',url('index/index'));
			}
		}
		else{
			//这是登录后再次回到登录页面时会自动跳转的功能的实现
			//获取session的值
			$account = session('bisAccount','','bis');
			if($account && $account->id){
				return $this->redirect(url('index/index'));
			}
			return $this->fetch();
		}
	}

	public function logout(){
		//清除bis作用域中的所有session数据
		session(null,'bis');
		$this->redirect('login/index');

	}

}
