<?php
namespace app\index\controller;
use think\Controller;


class Index extends Base{
    public function index(){
    	//获取首页大图
    	$big_urls = model('featured')->getBigImageUrls();
    	$right_url = model('featured')->getRightImageUrl();
    	//获取首页
    	return $this->fetch('',['big_urls'=>$big_urls,'right_url'=>$right_url]);
    }

    public function test(){
    	return \Map::getLngLat('泉州华侨大学');
    }

    public function map(){
    	return \Map::getStaticImage('泉州华侨大学');
    }

}
