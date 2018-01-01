<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;

class Category extends Controller
{
    public function index(){
    	// return 'hello monika';
        return $this->fetch();
    }

    public function add(){
        return $this->fetch();
    }

    public function save(Request $request){
        // print_r(request()->post());
        $data = request()->post();
        dump($data);
        // $data['id'] = 'a';
        // $validate = validate('Category');
        // if(!$validate->scene('add')->check($data)){
        //     $this->error($validate->getError());
        // }
        // $res = $this->obj->add($data);
        // if($res){
        //     $this->success('添加成功');
        // }
        // else{
        //     $this->error('添加失败');
        // }
    }
}
