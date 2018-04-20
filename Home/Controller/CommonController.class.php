<?php
namespace Home\Controller;
use Think\Controller;

class CommonController extends Controller {
    /**
     * 必须登录
     */
    public function _initialize()
    {
        $userid = session('userid');
        if(!$userid){
            if(IS_AJAX){
                echo ajax_return(0,'请先登录系统');exit;
            }else{
                redirect(U('login/password'),0,'no msg');
            }
        }
    }
}