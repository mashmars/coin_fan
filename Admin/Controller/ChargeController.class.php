<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Controller\BaseController;
class ChargeController extends BaseController {
    public function charge_list(){
		$p = I('param.p',1);
        $list = 10;
        $res = M('sys_charge')->page($p.','.$list)->order('id desc')->select();
        $count = M('sys_charge')->count();
        $page = new \Think\Page($count,$list);
        $show = $page->show();
        $this->assign('res',$res);
        $this->assign('page',$show);
        $this->assign('count',$count);
        $this->display();
	}
	public function charge_add(){
		$this->display();
	}
	public function ajax_charge_add(){
		$title = I('post.title');
		$bl = I('post.bl');
		if($title == '' || $bl == ''){
			echo ajax_return(0,'名称和比例不能为空');exit;
		}
		$data['title'] = $title;
		$data['bl'] = $bl;
		$data['createdate'] = time();
		$id = M('sys_charge')->add($data);
		if($id){
			echo ajax_return(1,'操作成功');
		}else{
			echo ajax_return(0,'操作失败');
		}
	}	
	
	public function charge_edit(){
		$id = I('param.id');
		$info = M('sys_charge')->find($id);
		$this->assign('info',$info);
		$this->display();
	}
	public function ajax_charge_edit(){
		$data = I('post.');
		//$info = M('sys_charge')->find($data['id']);
		$res = M('sys_charge')->save($data);
		if($res){
			echo ajax_return(1,'编辑成功');
		}else{
			echo ajax_return(0,'编辑失败');
		}
		
	}
	
	public function ajax_charge_del(){
		$id = I('post.id');
		$info = M('sys_charge')->find($id);
		if(!$info){
			echo ajax_return(0,'非法请求');exit;
		}
		if($info['status'] == 0){
			echo ajax_return(0,'非法请求1');exit;
		}
		$res = M('sys_charge')->delete($id);
		if($res){
			echo ajax_return(1,'删除成功');
		}else{
			echo ajax_return(0,'删除失败');
		}
	}
	
	//执行
	public function ajax_charge_zhixing(){
		$id = I('post.id');
		$info = M('sys_charge')->lock(true)->find($id);
		if(!$info){
			echo ajax_return(0,'非法请求');exit;
		}
		if($info['status'] == 0){
			echo ajax_return(0,'非法请求1');exit;
		}
		$rs = array();
		$mo = M();
		$mo->startTrans();
		$rs[] = $mo->table('sys_charge')->where(array('id'=>$id))->setField('status',0);
		$user_coin = M('user_coin')->where(array('lth'=>array('gt',0)))->select();
		foreach($user_coin as $coin){
			$num = round($coin['lth']*$info['bl'],4);
			if($num <= 0){
				continue;
			}
			$rs[] = $mo->table('user_coin')->where(array('id'=>$coin['id']))->setDec('lth',$num);
			//jilu
			$rs[] = $mo->table('sys_charge_log')->add(array('userid'=>$coin['userid'],'charge_id'=>$info['id'],'bl'=>$info['bl'],'num'=>$num,'createdate'=>time()));
		}
		
		if(check_arr($rs)){
			$mo->commit();
			echo ajax_return(1,'执行成功');
		}else{
			$mo->rollback();
			echo ajax_return(0,'执行失败');
		}
	}
	
	public function charge_log(){
		$p = I('param.p',1);
        $list = 10;
        $res = M('sys_charge_log')->alias('a')->join('left join sys_charge b on a.charge_id=b.id')->join('left join user c on a.userid=c.id')->field('a.*,b.title,c.phone,c.realname')->page($p.','.$list)->order('a.id desc')->select();
        $count = M('sys_charge_log')->count();
        $page = new \Think\Page($count,$list);
        $show = $page->show();
        $this->assign('res',$res);
        $this->assign('page',$show);
        $this->assign('count',$count);
        $this->display();
	}
}