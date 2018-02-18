<?php
namespace app\index\controller;
use think\Controller;


class Detail extends Base{
    public function index($id){
        // dump($id);exit;
        $flag = 0;
        $timedata = '';
        if(!intval($id)){
            $this->error('id不合法');
        }
        $deal = model('Deal')->get($id);
        if(!$deal || $deal->status != 1){
            $this->error('该商品不存在');
        }
        if($deal->start_time > time()){
            $flag = 1;

            $dtime = $deal->start_time-time();
            $d = floor($dtime/(3600*24));
            if($d){
                $timedata .= $d."天";
            }
            $h = floor($dtime%(3600*24)/3600);
            if($h){
                $timedata .= $h."小时";
            }
            $m = floor($dtime%(3600*24)%(3600)/60);
            if($m){
                $timedata .= $m."分";
            }
        }
    	return $this->fetch('',[
            'title' => $deal->name,
            'flag' => $flag,
            'timedata' => $timedata,
            'deal'=> $deal,
        ]);
    }


    public function test(){
    	return \Map::getLngLat('泉州华侨大学');
    }

    public function map(){
    	return \Map::getStaticImage('泉州华侨大学');
    }

}
