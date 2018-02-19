<?php
namespace app\index\controller;
use think\Controller;


class Lists extends Base{
    public function index(){
        $firstCatIds = [];
        $parent_id = 0;
        $se_id = 0;
        $data = [];
        $orders = [];
        $id = input('id',0,'intval');
        $firstCategorys = model('Category')->getNormalFirstCategorys();
        $secondCategorys = '';
        $category = model('Category')->getCategoryById($id);
        if($category){
            if($category['parent_id'] != 0){
                $parent_id = $category['parent_id'];
                $se_id = $id;
                $data['se_category_id'] = $id;
            }
            else if($category['parent_id'] == 0){
                $parent_id = $category['id'];
                $data['category_id'] = $id;
            }
            $secondCategorys = model('Category')->getSeCategorysByParentId($parent_id);
        }
        
        //排序
        $order_sales = input('order_sales','');
        $order_price = input('order_price','');
        $order_time = input('order_time','');
        $order_flag = '';
        if(!empty($order_sales)){
            $order_flag = 'order_sales';
            $orders['buy_count'] = 'desc';
        }
        if(!empty($order_price)){
            $order_flag = 'order_price';
            $orders['current_price'] = 'desc';
        }
        if(!empty($order_time)){
            $order_flag = 'order_time';
            $orders['start_time'] = 'asc';
        }

        $deals = model('Deal')->getDealsByData($data,$orders);

    	return $this->fetch('',[
            'firstCategorys' => $firstCategorys,
            'parent_id' => $parent_id,
            'secondCategorys' => $secondCategorys,
            'se_id' => $se_id,
            'order_flag' => $order_flag,
            'id' => $id,
            'deals'=>$deals,
        ]);
    }


}
