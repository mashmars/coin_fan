<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Controller\BaseController;
class IndexController extends BaseController {
    public function index(){
        $this->display();
    }
    public function welcome(){
		$start = mktime(0,0,0,date('m'),date('d'),date('Y'));
		$end = mktime(23,59,59,date('m'),date('d'),date('Y'));
		//当日转入总量
        $data['zr'] = M('myzr')->where(array('createdate'=>array('between',array($start,$end))))->sum('num');
        //当日转出总量
        $data['zc'] = M('myzc')->where(array('status'=>1,'createdate'=>array('between',array($start,$end))))->sum('num');
        //平台总量
        $data['total'] = M('user_coin')->sum('lth');
        //当日收益
        $data['income'] = M('sys_fh_log')->where(array('createdate'=>array('between',array($start,$end))))->sum('num');

        $this->assign('data',$data);
        $this->display();
    }
}