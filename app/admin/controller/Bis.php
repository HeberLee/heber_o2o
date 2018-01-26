<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;

class Bis extends Controller
{
    private $obj;

    public function _initialize(){
        $this->bis_obj = model('Bis');
        $this->city_obj = model('City');
        $this->category_obj = model('Category');
        $this->bis_location_obj = model('BisLocation');
        $this->bis_account_obj = model('BisAccount');
    }

	public function apply(){
        $bises = $this->bis_obj->getBises();
        return $this->fetch('',['bises'=>$bises]);
    }

    public function status(){
        $data = input('get.');
        $validate = validate('Category');
        if(!$validate->scene('status')->check($data)){
            $this->error($validate->getError());
        }
        $res = $this->bis_obj->update($data,['id'=>$data['id']]);
        if($res){
            $this->success('更新状态成功！');
        }
        else{
            $this->error('更新状态失败！');
        }
    }

    public function detail(){
        $id = input('get.id');
        if(empty($id)){
            return $this->error('ID错误');
        }

        $cities = $this->city_obj->getNormalCitiesByParentId();
        $categorys = $this->category_obj->getNormalFirstCategorys();
        //获取商户信息
        $bisData = $this->bis_obj->get($id);
        //将bis的城市从id转为名字


        $bisData['city_name'] = $this->bis_obj->getCityNameByPath($bisData['city_path']);
        // dump($bisData['city_name']); 
        
        $bisLocationData = $this->bis_location_obj->get(['bis_id'=>$id,'is_main'=>1]);
        $BisAccountData = $this->bis_account_obj->get($id);
        return $this->fetch('',[
            'cities' => $cities,
            'categorys' => $categorys,
            'bisData' => $bisData,
            'bisLocationData' => $bisLocationData,
            'BisAccountData' => $BisAccountData,
        ]);
    }
}
