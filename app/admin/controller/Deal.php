<?php
namespace app\admin\controller;
use think\Controller;

class Deal extends Controller
{
    public function _initialize(){
        $this->city_obj = model('City');
        $this->category_obj = model('Category');
        $this->bis_location_obj = model('BisLocation');
    }

    public function index()
    {
        $data = input('get.');
        $sdata = [];
        $deals = [];
        $cities = $this->city_obj->getNormalCities();
        $categorys = $this->category_obj->getNormalFirstCategorys();

        if(!empty($data['category_id'])){
            $sdata['category_id'] = $data['category_id'];
        }
        if(!empty($data['city_id'])){
            $sdata['city_id'] = $data['city_id'];
        }
        if(!empty($data['start_time']) && !empty($data['end_time']) && strtotime($data['end_time'])>strtotime($data['start_time'])){
            $sdata['create_time'] = [
                ['gt',strtotime($data['start_time'])],
                ['lt',strtotime($data['end_time'])]
            ];
        }

        if(!empty($data['name'])){
            $sdata['name'] = ['like','%'.$data['name'].'%'];
        }
        if(!empty($sdata)){
            $deals = model('deal')->getNormalDeals($sdata);
        }
        return $this->fetch('',[
            'cities'=>$cities,
            'categorys'=>$categorys,
            'deals'=>$deals,
            'category_id' => empty($data['category_id'])?'':$data['category_id'],
            'city_id' => empty($data['city_id'])?'':$data['city_id'],
            'name' => empty($data['name'])?'':$data['name'],
            'start_time' => empty($data['start_time'])?'':$data['start_time'],
            'end_time' => empty($data['end_time'])?'':$data['end_time'],
        ]);
        // return $this->fetch('',['cities'=>$cities,'categorys'=>$categorys]);
    }

}
