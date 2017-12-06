<?php
namespace app\admin\validate;
use think\Validate;

class Category extends Validate{
	protected $rule = [
		['name','require|max:10','不能为空'],
		['parent_id','number','应为数字'],
		['id','number','应为数字'],
		['status','number|in:-1,0,1','应为数字|超出指定范围'],
		['listorder','number','应为数字'],
	];
	/**场景设置**/
	protected $scene = [
		'add' => ['name','parent_id'],
		'listorder' => ['id','listorder'],
	];
}