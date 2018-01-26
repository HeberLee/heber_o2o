<?php
namespace app\admin\controller;
use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
     public function test(){
    	$data = model('BisLocation')->get(['bis_id'=>3,'is_main'=>1]);

        $cc[] = 1;
        $cc[] = $data; 
        
        dump($cc);
    }
    public function welcome(){
      //  \phpmailer\Email::send('907008122@qq.com','heelo','monika');
    	echo "surprise!";
    }
}
