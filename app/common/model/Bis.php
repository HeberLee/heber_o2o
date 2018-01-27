<?php
namespace app\common\model;
use think\Model;
use think\Request;

class Bis extends BaseModel{
	public function getBisesByStatus($status){
		$data = [
			// 'parent_id' => 0,
			'status'=> $status,
		];
		$order = [
			'create_time' => 'desc',
		];
		return $this->where($data)
					->order($order)
					->paginate(5);

	}

//根据城市数字路径来获取对应的中文名
	public function getCityNameByPath($path){
		if(preg_match('/,/',$path)){
            $city_path = explode(',',$path);
            $city_id = $city_path[0]; 
            $se_city_id = $city_path[1];
            $city_name[] = model('city')->where('id','eq',$city_id)->column('name');  
        	$city_name[] = model('city')->where('id','eq',$se_city_id)->column('name'); 
        }
        else{
        	$city_id = $path;
        	$city_name[] = model('city')->where('id','eq',$city_id)->column('name');  
        	//之所以使用两个中括号是为了符合输出格式。
        	$city_name[][] = '';
        }


        return $city_name;  
	}
}