<?php
namespace Home\Controller;
use Think\Controller;
use Home\Controller\CommonController;
class FinanceController extends CommonController {

    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
    }

    public function index(){
		$this->display();
	}

	/**
     * 资产管理
     */
	public function wallet()
    {
        $userid = session('userid');
        //本月收益
        $start =mktime(0,0,0,date('m'),1,date('Y'));
        $end =mktime(23,59,59,date('m'),date('t'),date('Y'));
        $month_shouyi = M('sys_fh_log')->where(array('userid'=>$userid,'createdate'=>array('between',array($start,$end))))->sum('num');
        //昨天收益
        //php获取昨日起始时间戳和结束时间戳
        $start1 =mktime(0,0,0,date('m'),date('d')-1,date('Y'));
        $end1 =mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
        $yestoday_shouyi = M('sys_fh_log')->where(array('userid'=>$userid,'createdate'=>array('between',array($start1,$end1))))->sum('num');
        $this->assign('month_shouyi',$month_shouyi);
        $this->assign('yestoday_shouyi',$yestoday_shouyi);
        $this->display();
    }
    /**
     * 我的转入页面
     */
    public function myzr()
    {

        $userid = session('userid');
        $phone = session('phone');
        $wallet = M('user_coin')->where(array('userid'=>$userid))->find();
        //没有钱包地址先生成
        if(!$wallet['lthb']){
            Vendor("Move.ext.client");
            $user = C('wallet_user');
            $pwd = C('wallet_pwd');
            $host = C('wallet_host');
            $port = C('wallet_port');
            //$client = new \client($user,$pwd,$host,$port, 5, [], 1); //暂时不能用 。。。。。
           $client = new \client('12','123...', '127.0.0.1', 29316, 5, [], 1);

            if(!$client){
                $qianbao = '';
            }else{
                //从服务器上获取当前手机号的钱包地址
                $qianbao_addr = $client->getaddressesbyaccount($phone);
                //var_dump($qianbao_addr);exit;
                if (!is_array($qianbao_addr)) {
                    $qianbao_ad = $client->getnewaddress($phone);

                    if (!$qianbao_ad) {
                        $qianbao = '';
                    }else {
                        $qianbao = $qianbao_ad;
                        M('user_coin')->where(array('userid'=>$userid))->save(array('lthb'=>$qianbao));
                    }
                }else{
                    $qianbao = $qianbao_addr[0];
                    M('user_coin')->where(array('userid'=>$userid))->save(array('lthb'=>$qianbao));
                }
            }
        }else{
            $qianbao = $wallet['lthb'];
        }
        $this->assign('qianbao',$qianbao);
        $this->display();
    }

    public function myzrdetail()
    {
        $userid = session('userid');
        $p = I('param.p',1);
        $list = 5;
        $res = M('myzr')->where(array('userid'=>$userid))->order('id desc')->page($p.','.$list)->select();
        $this->assign('res',$res);
        $this->display();
    }
    /**
     * 转入记录
     */
    public function ajax_myzrdetail()
    {
        $userid = session('userid');
        $p = I('param.p',1);
        $list = 5;
        $res = M('myzr')->where(array('userid'=>$userid))->order('id desc')->page($p.','.$list)->select();
        foreach($res as &$v){
            $v['date'] = date('m/d');
            $v['time'] = date('H:i');
        }
        echo json_encode($res);
    }

    /**
     * 转出页面
     */
    public function myzc()
    {
        //我的钱包地址
        $address = M('user_qianbao')->where(array('userid'=>session('userid')))->select();
		//手续费
		$fee = M('config')->where('id=1')->getField('zc_fee');

        $this->assign('fee',$fee);
        $this->assign('address',$address);
        $this->display();
    }
    /*
	地址列表
	*/
	public function address(){
		$userid = session('userid');
		$res = M('user_qianbao')->where(array('userid'=>$userid))->select();
		$this->assign('res',$res);
		$this->display();
	}
	public function ajax_address_del(){
		$id = I('post.id');
		$userid = session('userid');
		$info = M('user_qianbao')->where(array('id'=>$id,'userid'=>$userid))->find();
		if(!$info){
			echo ajax_return(0,L('error'));exit;
		}
		$res = M('user_qianbao')->delete($id);
		if($res){
			echo ajax_return(1,L('success'));
		}else{
			echo ajax_return(0,L('error'));
		}
	}
	/*地址类型
	*/
	public function zcwallet(){
		$id = I('param.id');
		$userid = session('userid');
		if($id){ //存在id是编辑
			$info = M('user_qianbao')->where(array('id'=>$id,'userid'=>$userid))->find();
			if(!$info){
				redirect(U('finance/address'));
			}
			$this->assign('info',$info);
		}
		
		$this->display();
	}
    /**
     *添加我的转出钱包地址
     */
    public function ajax_add_myzc_wallet()
    {
        $name = I('post.name');
        $address = I('post.address');
        $id = I('post.id');
        if($name == '' || $address == ''){
            echo ajax_return(0,L('sign_address_set_empty'));exit;
        }
        $userid = session('userid');
		if($id){
			//编辑
			$info = M('user_qianbao')->where(array('id'=>$id,'userid'=>$userid))->find();
			if(!$info){
				echo ajax_return(0,L('error'));exit;
			}
			$res = M('user_qianbao')->where(array('id'=>$id))->setField(array('name'=>$name,'address'=>$address));
		}else{
			//新增
			$res = M('user_qianbao')->add(array('userid'=>$userid,'name'=>$name,'address'=>$address,'createdate'=>time()));
		}
        
        if($res){
            echo ajax_return(1,L('success'));exit;
        }else{
            echo ajax_return(0,L('error'));exit;
        }
    }

    /**
     * 转出发送短信
     */
    public function ajax_send_sms_myzc()
    {
        $phone = session('phone');
        //如果短信存在则不让再发
        if(session($phone . 'myzc')){
            echo ajax_return(1,L('sended'));exit;
        }
		//判断是否有转出权限
		$user = M('user')->where(array('id'=>session('userid')))->find();
		if(!$user['finance_status']){
			echo ajax_return(1,L('out_error1'));exit;
		}
        $code = mt_rand(10000, 99999);
        $result = send_sms('72713', $phone, $code);
        if ($result['info'] == 'success') {
            session($phone . 'myzc', $code);
            echo ajax_return(1, L('send'));
        } else {
            echo ajax_return(0, $result['msg']);
        }
    }
    /**
     * 转出提交
     */
    public function ajax_myzc()
    {
        $mum = I('post.num');
        $sms = I('post.sms');
        $address = I('post.address');
        $paypassword = I('post.paypassword');

        $userid = session('userid');
        $phone = session('phone');
		//判断是否有转出权限
		$user = M('user')->where(array('id'=>session('userid')))->find();
		if(!$user['finance_status']){
			echo ajax_return(1,L('out_error1'));exit;
		}
        //判断短信验证码是否正确
        if($sms != session($phone . 'myzc')){
            echo ajax_return(0,L('sms_set_error'));exit;
        }
        //判断address 是否存在
        $address = M('user_qianbao')->where(array('userid'=>$userid,'id'=>$address))->find();
        if(!$address){
            echo ajax_return(0,L('address_not_exist'));exit;
        }

        //判断交易密码是否正确
        $password = M('user')->where(array('id'=>$userid))->getField('paypassword');
        if($password != md5($paypassword)){
            echo ajax_return(0,L('paypassword_set_error'));exit;
        }

        //判断数量是否正确
        if($mum <= 0 || !is_numeric($mum)){
            echo ajax_return(0,L('number_set_error'));exit;
        }
        
		//手续费
		$zc_fee = M('config')->where('id=1')->getField('zc_fee');
		$fee = round($zc_fee * $mum,2);
		$num = $mum - $fee;
		$user_coin = M('user_coin')->where(array('userid'=>$userid))->find();
		if($user_coin['lth'] < $mum){
            echo ajax_return(0,L('number_set_error1'));exit;
        }
		
		//新增控制 最大可提数量 规则是：如果个人tb_bl==0,则走config的tb_bl全局比例，否则优先走个人的 浮点判断 必须是大于0 
		if($user['tb_bl']>0){
			$max = $user_coin['lth']*$user['tb_bl'];
		}else{
			$cfg = M('config')->find(1);
			if($cfg['tb_bl']>0){
				$max = $user_coin['lth']*$cfg['tb_bl'];
			}else{
				//这个暂时用作必须设置提币比例 否则是不让提的
				$max = 0;
			}
		}
		if($mum > $max){
			echo ajax_return(0,L('number_set_error2'));exit;
		}
		
        //可以转出
        $mo = M();
        $mo->startTrans();
        $rs = array();
        $rs[] = $mo->table('user_coin')->where(array('userid'=>$userid))->setDec('lth',$mum);
        $rs[] = $mo->table('user_coin')->where(array('userid'=>$userid))->setInc('lthd',$mum);
         $rs[] = $mo->table('myzc')->add(array('userid'=>$userid,'address'=>$address['address'],'mum'=>$mum,'fee'=>$fee,'num'=>$num,'createdate'=>time()));

        if(check_arr($rs)){
            $mo->commit();
			session($phone . 'myzc', '');
            echo ajax_return(1,L('out_success'));
        }else{
            $mo->rollback();
            echo ajax_return(0,L('out_error'));
        }

    }

    public function myzcdetail()
    {
        $userid = session('userid');
        $p = I('param.p',1);
        $list = 5;
		//扣费
		$charge = M('sys_charge_log')->where(array('userid'=>$userid))->order('id desc')->select();
        $res = M('myzc')->where(array('userid'=>$userid))->order('id desc')->page($p.','.$list)->select();
        $this->assign('charge',$charge);
        $this->assign('res',$res);
        $this->display();
    }
    /**
     * 转出记录
     */
    public function ajax_myzcdetail()
    {
        $userid = session('userid');
        $p = I('param.p',1);
        $list = 5;
        $res = M('myzc')->where(array('userid'=>$userid))->order('id desc')->page($p.','.$list)->select();
        foreach($res as &$v){
            $v['date'] = date('m/d');
            $v['time'] = date('H:i');
        }
        echo json_encode($res);
    }

    public function income()
    {
        $userid = session('userid');
        $p = I('param.p',1);
        $list = 5;
        $res = M('sys_fh_log')->where(array('userid'=>$userid))->order('id desc')->page($p.','.$list)->select();
        $this->assign('res',$res);
        $this->display();
    }
    /**
     * 收益记录
     */
    public function ajax_income()
    {
        $userid = session('userid');
        $p = I('param.p',1);
        $list = 5;
        $res = M('sys_fh_log')->where(array('userid'=>$userid))->order('id desc')->page($p.','.$list)->select();
        foreach($res as &$v){
            $v['date'] = date('m/d');
            $v['time'] = date('H:i');
        }
        echo json_encode($res);
    }
	
	
	 /**
     * 会员转账
     */
    public function transfer()
    {
        $this->display();
    }
    public function ajax_transfer()
    {
        $userid = session('userid');
        $phone = I('post.phone');
        $money = I('post.money');
        $password = I('post.password');

        
        if($money <=0 || !is_numeric($money)){
            echo ajax_return(0,L('money_set_error'));exit;
        }

        
        
        $info = M('user')->where(array('phone'=>$phone))->find();
        if(!$info){
            echo ajax_return(0,L('refer_to_set_error'));exit;
        }
		$from = M('user')->where(array('id'=>$userid))->find();
        if($from['paypassword'] != md5($password)){
            echo ajax_return(0,L('paypassword_set_error'));exit;
        }
		if($info['id'] == $userid){
            echo ajax_return(0,L('refer_to_yourself_error'));exit;
        }
		
		
		//判断是否有转出权限		
		if(!$from['finance_status']){
			echo ajax_return(1,L('transfer_error'));exit;
		}
		//手续费
		$zz_fee = M('config')->where('id=1')->getField('zz_fee');
		$num = $money;
		$fee = round($num*$zz_fee,2);
		$mum = $num + $fee;
		
		
		/**
		* 必须是推荐关系 或节点关系 
		
		//我给节点上级转 或推荐人转
		$map['ownid'] = $info['id'];
		$map['pid'] = $info['id'];
		$map['_logic'] = 'or';
		$where['_complex'] = $map;
		$where['userid'] = $userid;
		$up = M('user_zone')->where($where)->find();
		
		//我给节点下级转 或给我推荐的人转
		
		$dd['pid'] = $from['id'];
		$dd['ownid'] = $from['id'];
		$dd['_logic'] = 'or';
		$dd1['_complex'] = $dd;
		$dd1['userid'] = $info['id'];
		$down = M('user_zone')->where($dd1)->find();
		*/
		
		/*$map['userid'] = $userid;
		$map['ownid'] = $info['id'];
		$up = M('user_zone')->where($map)->find(); //往上转
		*/
		$up = $this->get_shangji($userid,$info['id']);
		//往下
		$down = $this->get_xiaji($userid,$info['id']);
		
		
		if(!$up && !$down){
			echo ajax_return(0,L('transfer_error1'));exit;
		}
		
		
        $user_coin = M('user_coin')->where(array('userid'=>$userid))->lock(true)->find();

        if($user_coin['lth'] < $mum){
            echo ajax_return(0,L('money_set_error1'));exit;
        }
		
		//新增控制 最大可提数量 规则是：如果个人tb_bl==0,则走config的tb_bl全局比例，否则优先走个人的 浮点判断 必须是大于0 
		if($from['tb_bl']>0){
			$max = $user_coin['lth']*$from['tb_bl'];
		}else{
			$cfg = M('config')->find(1);
			if($cfg['tb_bl']>0){
				$max = $user_coin['lth']*$cfg['tb_bl'];
			}else{
				//这个暂时用作必须设置提币比例 否则是不让提的
				$max = 0;
			}
		}
		if($mum > $max){
			echo ajax_return(0,L('number_set_error2'));exit;
		}
        
        //可以转
        $mo = M();
        $mo->startTrans();
        $rs = array();

        $rs[] = $mo->table('user_coin')->where(array('userid'=>$userid))->setDec('lth',$mum);
        $rs[] = $mo->table('user_coin')->where(array('userid'=>$info['id']))->setInc('lth',$num);
        $rs[] = $mo->table('mytransfer')->add(array('userid'=>$userid,'peerid'=>$info['id'],'num'=>$num,'fee'=>$fee,'mum'=>$mum,'phone'=>$phone,'createdate'=>time()));

        if(check_arr($rs)){
            $mo->commit();
            echo ajax_return(1,L('success'));
        }else{
            $mo->rollback();
            echo ajax_return(0,L('error'));
        }
    }
	//往上找 一条线
	public function get_shangji($userid,$shangji){
		$users = M('user_zone')->where(array('userid'=>$userid))->field('zone,pid')->find();
		if(!$users['pid']){
			return false;
		}
		if($users['pid'] == $shangji){
			return true;
		}else{
			return $this->get_shangji($users['pid'],$shangji);
		}
	} 
	//获取两条线 和queue一样
	public function get_xiaji($userid,$xiaji)
	{
		$users = M('user_zone')->where(array('pid'=>$userid))->field('zone,userid')->select();
		foreach($users as $user){
			if($user['zone'] == 1){
				//第一个区
				$users_a = $this->get_small_zone($user['userid']);
			}elseif($user['zone'] == 2){
				//第二个区
				$users_b = $this->get_small_zone($user['userid']);
			}
		}
		if($users_a){
			if(in_array($xiaji,$users_a)){
				return true;
			}
		}
		if($users_b){
			if(in_array($xiaji,$users_b)){
				return true;
			}
		}
		return false;
	}
	//获取小区用户
	public function get_small_zone($userid,$new=true)
	{
		static $users = array();
		if($new){
			$users = array();//必须释放
		}
		array_push($users,$userid);
		$user_xiaji = M('user_zone')->where(array('pid'=>$userid))->getField('userid',true);
		if($user_xiaji){
			foreach($user_xiaji as $user){
				$this->get_small_zone($user,false);
			}				
		}
		return $users;
	}


    /**
     * 会员转账记录
     */
    public function transferlog()
    {
        $userid = session('userid');
        $p = I('param.p',1);
        $list = 5;
        $map['userid'] = $userid;
        $map['peerid'] = $userid;
        $map['_logic'] = 'or';
        $res = M('mytransfer')->where($map)->order('id desc')->page($p.','.$list)->select();
        foreach($res as &$v){
            if($v['userid'] == $userid){
                $v['type'] = 'zc';
				$v['phone'] = M('user')->where(array('id'=>$v['peerid']))->getField('phone');
            }
            if($v['peerid'] == $userid){
                $v['type'] = 'zr';
				$v['phone'] = M('user')->where(array('id'=>$v['userid']))->getField('phone');
            }
        }
        $this->assign('res',$res);
        $this->display();
    }
    /**
     * 会员转账记录
     */
    public function ajax_transferlog()
    {
        $userid = session('userid');
        $p = I('param.p',1);
        $list = 5;
        $map['userid'] = $userid;
        $map['peerid'] = $userid;
        $map['_logic'] = 'or';
        $res = M('mytransfer')->where($map)->order('id desc')->page($p.','.$list)->select();
        foreach($res as &$v){
            $v['date'] = date('m/d');
            $v['time'] = date('H:i');
            if($v['userid'] == $userid){
                $v['type'] = 'zc';
				$v['phone'] = M('user')->where(array('id'=>$v['peerid']))->getField('phone');
            }
            if($v['peerid'] == $userid){
                $v['type'] = 'zr';
				$v['phone'] = M('user')->where(array('id'=>$v['userid']))->getField('phone');
            }
        }
        echo json_encode($res);
    }


}