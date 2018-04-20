<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Auth;
class BaseController extends Controller {
    
    public function _initialize(){ 
        header("Content-type: text/html; charset=utf-8");
        if(!session('adminid')){
            $this->redirect('login/login','',0,'请先登录系统');            
		   //redirect('/admin.php/login/login');
        }
		
    }
    
}