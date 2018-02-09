<?php
namespace app\admin\controller;
use think\Controller;

class Location extends Controller
{
    public function _initialize(){
        $this->bis_obj = model('Bis');
        $this->city_obj = model('City');
        $this->category_obj = model('Category');
        $this->bis_location_obj = model('BisLocation');
        $this->bis_account_obj = model('BisAccount');
    }

    public function index()
    {
        $locations = $this->bis_location_obj->getLocations();
        return $this->fetch('',['locations'=>$locations]);
    }

    public function apply(){
        $locations = $this->bis_location_obj->getApplyLocations();
        return $this->fetch('',['locations'=>$locations]);
    }

    public function delete(){
        return $this->fetch();
    }

    //修改状态，2表示不通过，1表示正常，0表示等待，-1表示删除。
    public function status(){
        $data = input('get.');
        // $validate = validate('Bis');
        // if(!$validate->scene('status')->check($data)){
        //     $this->error($validate->getError());
        // }
        // dump($data);
        $res = $this->bis_location_obj->update($data);

        if($res){
            $this->success('更新状态成功！');
        }
        else{
            $this->error('更新状态失败！');
        }
    }
}
