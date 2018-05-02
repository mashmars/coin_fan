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
		$auth = new Auth();
		if(CONTROLLER_NAME !='Index' && CONTROLLER_NAME !='Login'){
			if(!$auth->check(CONTROLLER_NAME.'/'.ACTION_NAME, session('adminid'))){
				if(IS_AJAX){
					echo json_encode(array('info'=>'error','msg'=>'你没有操作权限'));
					exit;
				}else{
					exit('你没有操作权限');
				}
			}
		}
    }
    
}