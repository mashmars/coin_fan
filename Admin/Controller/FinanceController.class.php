<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Controller\BaseController;
class FinanceController extends BaseController {
    /**
     * 转入记录
     */
    public function myzr()
    {
        $p = I('param.p',1);
        $list = 10;
        $res = M('myzr')->alias('a')->join('left join user b on a.userid=b.id')->field('a.*,b.phone,b.username')->page($p.','.$list)->order('id desc')->select();
        $count = M('myzr')->alias('a')->join('left join user b on a.userid=b.id')->count();
        $page = new \Think\Page($count,$list);
        $show = $page->show();
        $this->assign('res',$res);
        $this->assign('page',$show);
        $this->assign('count',$count);
        $this->display();
    }
    /**
     * 转出记录
     */
    public function myzc()
    {
        $p = I('param.p',1);
        $list = 10;
		
		$field = I('param.field');
		$keyword = I('param.keyword');
		$status = I('param.status');
		if($status != ''){
			$map['a.status'] = $status;
		}
		if($field == 'phone' && $keyword){
			$userid = M('user')->where(array('phone'=>$keyword))->getField('id');
			if($userid){
				$map['userid'] = $userid;
			}
		}elseif($field == 'address' && $keyword){
			$map['a.address'] = $keyword;
		}
		//var_dump($map);
        $res = M('myzc')->alias('a')->join('left join user b on a.userid=b.id')->where($map)->field('a.*,b.phone,b.username')->page($p.','.$list)->order('a.id desc')->select();
        $count = M('myzc')->alias('a')->join('left join user b on a.userid=b.id')->where($map)->count();
        $page = new \Think\Page($count,$list);
		foreach($map as $key=>$val){
			$pos = strpos($key,'.');
			if($pos){
				$key = substr($key,$pos+1);
			}
			if($key == 'userid'){
				$page->parameter['field'] = 'phone';
				$page->parameter['keyword'] = $keyword;
			}elseif($key == 'address'){
				$page->parameter['field'] = 'address';
				$page->parameter['keyword'] = $keyword;
			}else{
				$page->parameter[$key] = $val;
			}
			
		}
        $show = $page->show();
        $this->assign('res',$res);
        $this->assign('page',$show);
        $this->assign('count',$count);
        $this->assign('field',$field);
        $this->assign('keyword',$keyword);
        $this->assign('status',$status);
        $this->display();
    }

    /**
     * 审核通过转出审核
     */
    public function ajax_myzc_shenhe()
    {
        $id = I('post.id');
        $info = M('myzc')->where(array('id'=>$id))->lock(true)->find();
        if(!$info){
            echo ajax_return(0,'请求有误');exit;
        }
        if($info['status'] == 1){
            echo ajax_return(0,'已审核，无需重复操作');exit;
        }
        if($info['status'] == 2){
            echo ajax_return(0,'此请求已拒绝，无需重复操作');exit;
        }
        $mo = M();
        $mo->startTrans();
        $rs = array();
        $rs[] = M('myzc')->where(array('id'=>$id))->setField('status',1);
        $rs[] = M('user_coin')->where(array('userid'=>$info['userid']))->setDec('lthd',$info['mum']);

        if(check_arr($rs)){
            $mo->commit();
            echo ajax_return(1,'审核成功');
        }else{
            $mo->rollback();
            echo ajax_return(0,'审核失败');
        }
    }
    /**
     * 审核通过转出拒绝
     */
    public function ajax_myzc_refuse()
    {
        $id = I('post.id');
        $info = M('myzc')->where(array('id'=>$id))->lock(true)->find();
        if(!$info){
            echo ajax_return(0,'请求有误');exit;
        }
        if($info['status'] == 1){
            echo ajax_return(0,'已审核，不能拒绝');exit;
        }
        if($info['status'] == 2){
            echo ajax_return(0,'已拒绝，无需重复操作');exit;
        }
        $mo = M();
        $mo->startTrans();
        $rs = array();
        $rs[] = M('myzc')->where(array('id'=>$id))->setField('status',2);
        $rs[] = M('user_coin')->where(array('userid'=>$info['userid']))->setDec('lthd',$info['mum']);
        $rs[] = M('user_coin')->where(array('userid'=>$info['userid']))->setInc('lth',$info['mum']);

        if(check_arr($rs)){
            $mo->commit();
            echo ajax_return(1,'审核成功');
        }else{
            $mo->rollback();
            echo ajax_return(0,'审核失败');
        }
    }
}