<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;

class Category extends Controller
{
	private $obj;

	public function _initialize(){
		$this->obj = model('Category');
	}
    public function index($parent_id=0){
    	// return 'hello monika';
    	$categorys = $this->obj->getCategorysByParentId($parent_id);
        return $this->fetch('',[
        	'categorys' => $categorys,
        ]);
    }

    public function add(){
    	$categorys = $this->obj->getNormalFirstCategorys();
        return $this->fetch('',[
        	'categorys' => $categorys,
        ]);
    }

    public function edit($id){
    	if(intval($id) < 1){
    		$this->error('参数不合法');
    	}
    	$category = $this->obj->get($id);
    	$categorys = $this->obj->getNormalFirstCategorys();
        return $this->fetch('',[
        	'category' => $category,
        	'categorys' => $categorys,
        ]);
    }

    public function save(Request $request){
        // print_r(request()->post());
        $data = request()->post();
        $validate = validate('Category');
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        $res = $this->obj->add($data);
        
        if($res){
            $this->success('添加成功');
        }
        else{
            $this->error('添加失败');
        }
    }

    public function resave(Request $request){
        // print_r(request()->post());
        $data = request()->post();

        $validate = validate('Category');
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        $res = $this->obj->update($data,['id' => $data['id']]);
        
        if($res){
            $this->success('更新分类成功');
        }
        else{
            $this->error('更新分类失败');
        }
    }

    public function listorder($id,$listorder){
    	$res = $this->obj->update(['listorder' => $listorder],['id' => $id]);
    	if($res){
    		$this->result($_SERVER['HTTP_REFERER'],1,'success');
    	}
    	else{
    		$this->result($_SERVER['HTTP_REFERER'],0,'fail');

    	}
    }

    public function status(){
    	$data = input('get.');
    	$validate = validate('Category');
        if(!$validate->scene('status')->check($data)){
            $this->error($validate->getError());
        }
        $res = $this->obj->update($data,['id' => $data['id']]);
        if($res){
            $this->success('更新状态成功');
        }
        else{
            $this->error('更新状态失败');
        }
    }
}
