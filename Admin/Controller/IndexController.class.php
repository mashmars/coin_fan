<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Controller\BaseController;
class IndexController extends BaseController {
    public function index(){
        $this->display();
    }
    public function welcome(){
		
		
        $this->display();
    }
}