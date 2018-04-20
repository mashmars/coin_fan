<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends Controller {
	public function index(){
		
		Vendor("Move.ext.client");
	//	$client = new \client('username123','543asdjkdjf', '120.78.75.93', 31253, 5, [], 1);
		$client = new \client('a5c','543', '127.0.0.1', 31253, 5, [], 1);
		if (!$client) {
			var_dump('aaa');
		}else{
			var_dump('a');
			echo '<pre>';
			//var_dump($client);
			$res = $client->execute("listtransactions", ["*", 20, 0]);
			//$res = $client->execute("getinfo");
			//$res = $client->getnewaddress();//生成新地址			
			var_dump($res);
			//$res = $client->getaddressesbyaccount('15890143123');//获取新地址
			//	var_dump($res);
		}
		var_dump('dd');exit;
		$this->display();
	}
}