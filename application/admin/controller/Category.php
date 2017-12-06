<?php
namespace app\admin\controller;
use think\Controller;

class Category extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
     public function add()
    {
        return $this->fetch();	
    }
    public function save(){
        // print_r(request()->post());
        $data = request()->post();
        // $data['id'] = 'a';
        $validate = validate('Category');
        if(!$validate->scene('listorder')->check($data)){
            $this->error($validate->getError());
        }
    }
}
