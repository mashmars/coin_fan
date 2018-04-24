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
        //用户基本信息
        $userinfo = M('user')->where(array('id'=>$userid))->find();
        $this->assign('userinfo',$userinfo);
        //获取用户资产
        $usercoin = M('user_coin')->where(array('userid'=>$userid))->find();
        $this->assign('usercoin',$usercoin);
        //获取分红
        $shouyi = M('sys_fh_log')->where(array('userid'=>$userid))->sum('num');
        $this->assign('shouyi',$shouyi);
        //获取网站基本配置
        $config = M('config')->where('id=1')->find();
        $this->assign('config',$config);
    }
}