<?php
namespace app\admin\controller;
use think\Controller;

class Featured extends Controller
{
    public function _initialize(){
        $this->bis_obj = model('Bis');
        $this->city_obj = model('City');
        $this->category_obj = model('Category');
        $this->bis_location_obj = model('BisLocation');
        $this->bis_account_obj = model('BisAccount');
        $this->featured_obj = model('Featured');
    }

    public function index()
    {
        $type = input('get.type',0,'intval');
        $featureds = $this->featured_obj->getFeaturedsByType($type);

        $types = config('featured.featured_type');
        return $this->fetch('',['types'=>$types,'featureds'=>$featureds,'type'=>$type]); 
    }


    public function add(){
        //获取推荐位类别
        if(request()->isPost()){
            $data = input('post.');
            $id = $this->featured_obj->add($data);
            if(!empty($id)){
                return $this->success('添加成功','featured/index');
            }
            else{
                return $this->error('添加失败','featured/add');
            }
        }
        else{
           $types = config('featured.featured_type');
            return $this->fetch('',['types'=>$types]); 
        }
        
    }

    //修改状态，2表示不通过，1表示正常，0表示等待，-1表示删除。
    public function status(){
        $data = input('get.');
        // $validate = validate('Bis');
        // if(!$validate->scene('status')->check($data)){
        //     $this->error($validate->getError());
        // }
        // dump($data);
        $res = $this->featured_obj->update($data);

        if($res){
            $this->success('更新状态成功！');
        }
        else{
            $this->error('更新状态失败！');
        }
    }
}
