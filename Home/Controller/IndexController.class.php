<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {
	public function index(){

	    $userid = session('userid');
	    if($userid){
	        redirect(U('user/index'));
        }else{
	        redirect(U('login/password'));
        }
		exit;

		Vendor("Move.ext.client");

		$client = new \client('a5c','543', '127.0.0.1', 31253, 5, [], 1);
		if (!$client) {
			var_dump('aaa');
		}else{
			var_dump('a');
			echo '<pre>';
			//var_dump($client);
			//$res = $client->execute("listtransactions", ["*", 20, 0]);
			//$res = $client->execute("getinfo");
			$res = $client->getnewaddress();//生成新地址			
			//var_dump($res);
			//$res = $client->getaddressesbyaccount('15890143123');//获取新地址
				var_dump($res);
		}
		var_dump('dd');exit;
		$this->display();
	}
	public function dddd(){
		$users = M('dd_user')->order('id asc')->select();
		foreach($users as $v){
			if($v['reg_user']){
				$pid = $v['reg_user'];
			}elseif($v['reg_user']==0 && $v['parent1']){
				$pid =1;
			}else{
				$pid=0;
			}
			if(M('user')->where(array('phone'=>$v['login_name']))->getField('id')){
				continue;
			}
			$id = M('user')->add(array('id'=>$v['id'],'pid'=>$pid,'username'=>$v['login_name'],'phone'=>$v['login_name'],'password'=>$v['login_pass'],'paypassword'=>$v['login_pass'],
				'realname'=>$v['nickname'],'createdate'=>time()
			));
			if($id){
				//资产表
				M('user_coin')->add(array('userid'=>$v['id'],'lth'=>$v['money']));
				//分区表
				if($v['parent1'] == 0){
					$zone=0;
				}elseif($v['pos'] == 0){
					$zone = 1;
				}elseif($v['pos'] == 1){
					$zone = 2;
				}
				M('user_zone')->add(array('userid'=>$v['id'],'ownid'=>$pid,'pid'=>$v['parent1'],'zone'=>$zone));
			}
		}
		echo 'dd';
	}
}