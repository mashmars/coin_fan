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
            $client = new \client('a5c','543', '127.0.0.1', 31253, 5, [], 1);

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
            $v['date'] = date('m月d日');
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

        $this->assign('address',$address);
        $this->display();
    }
    /**
     *添加我的转出钱包地址
     */
    public function ajax_add_myzc_wallet()
    {
        $name = I('post.name');
        $address = I('post.address');
        if($name == '' || $address == ''){
            echo ajax_return(0,'钱包标识和钱包地址不能为空');exit;
        }
        $userid = session('userid');

        $res = M('user_qianbao')->add(array('userid'=>$userid,'name'=>$name,'address'=>$address,'createdate'=>time()));
        if($res){
            echo ajax_return(1,'添加成功');exit;
        }else{
            echo ajax_return(0,'添加失败');exit;
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
            echo ajax_return(1,'短信已发送');exit;
        }
        $code = mt_rand(10000, 99999);
        $result = send_sms('72713', $phone, $code);
        if ($result['info'] == 'success') {
            session($phone . 'myzc', $code);
            echo ajax_return(1, '短信验证码发送成功');
        } else {
            echo ajax_return(0, $result['msg']);
        }
    }
    /**
     * 转出提交
     */
    public function ajax_myzc()
    {
        $num = I('post.num');
        $sms = I('post.sms');
        $address = I('post.address');
        $paypassword = I('post.paypassword');

        $userid = session('userid');
        $phone = session('phone');
        //判断短信验证码是否正确
        if($sms != session($phone . 'myzc')){
            echo ajax_return(0,'短信验证码不正确');exit;
        }
        //判断address 是否存在
        $address = M('user_qianbao')->where(array('userid'=>$userid,'id'=>$address))->find();
        if(!$address){
            echo ajax_return(0,'转出地址不存在');exit;
        }

        //判断交易密码是否正确
        $password = M('user')->where(array('id'=>$userid))->getField('paypassword');
        if($password != md5($paypassword)){
            echo ajax_return(0,'支付密码不正确');exit;
        }

        //判断数量是否正确
        if($num <= 0 || !is_numeric($num)){
            echo ajax_return(0,'数量格式不正确');exit;
        }
        $user_coin = M('user_coin')->where(array('id'=>$userid))->find();
        if($user_coin['lth'] < $num){
            echo ajax_return(0,'数量不足');exit;
        }

        //可以转出
        $mo = M();
        $mo->startTrans();
        $rs = array();
        $rs[] = $mo->table('user_coin')->where(array('userid'=>$userid))->setDec('lth',$num);
        $rs[] = $mo->table('user_coin')->where(array('userid'=>$userid))->setInc('lthd',$num);
        $rs[] = $mo->table('myzc')->add(array('userid'=>$userid,'address'=>$address['address'],'num'=>$num,'createdate'=>time()));

        if(check_arr($rs)){
            $mo->commit();
            echo ajax_return(1,'转出申请提交成功，请等待后台审核');
        }else{
            $mo->rollback();
            echo ajax_return(0,'转出申请提交失败');
        }

    }

    public function myzcdetail()
    {
        $userid = session('userid');
        $p = I('param.p',1);
        $list = 5;
        $res = M('myzc')->where(array('userid'=>$userid))->order('id desc')->page($p.','.$list)->select();
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
            $v['date'] = date('m月d日');
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
            $v['date'] = date('m月d日');
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
            echo ajax_return(0,'金额不正确');exit;
        }

        
        
        $info = M('user')->where(array('phone'=>$phone))->find();
        if(!$info){
            echo ajax_return(0,'输入的对方信息不正确');exit;
        }
		$from = M('user')->where(array('id'=>$userid))->find();
        if($from['paypassword'] != md5($password)){
            echo ajax_return(0,'支付密码不正确');exit;
        }
		if($info['id'] == $userid){
            echo ajax_return(0,'不能给自己转账');exit;
        }
		/**
		* 必须是推荐关系 或节点关系 
		*/
		//我给节点上级转 或推荐人转
		$map['userid'] = $userid;
		$map['ownid'] = $info['id'];
		$map['pid'] = $info['id'];
		$map['_logic'] = 'or';
		$up = M('user_zone')->where($map)->find();
		
		//我给节点下级转 或给我推荐的人转
		$where['userid'] = $userid;
		$where['pid'] = $from['id'];
		$where['ownid'] = $from['id'];
		$where['_logic'] = 'or';
		$down = M('user_zone')->where($where)->find();
		
		if(!$up && !$down){
			echo ajax_return(0,'只能直属上下级或推荐关系的账户转账');exit;
		}
		
		
        $user_coin = M('user_coin')->where(array('userid'=>$userid))->lock(true)->find();

        if($user_coin['lth'] < $money){
            echo ajax_return(0,'余额不足');exit;
        }
        
        //可以转
        $mo = M();
        $mo->startTrans();
        $rs = array();

        $rs[] = $mo->table('user_coin')->where(array('userid'=>$userid))->setDec('lth',$money);
        $rs[] = $mo->table('user_coin')->where(array('userid'=>$info['id']))->setInc('lth',$money);
        $rs[] = $mo->table('mytransfer')->add(array('userid'=>$userid,'peerid'=>$info['id'],'num'=>$money,'phone'=>$phone,'createdate'=>time()));

        if(check_arr($rs)){
            $mo->commit();
            echo ajax_return(1,'转账成功');
        }else{
            $mo->rollback();
            echo ajax_return(0,'转账失败');
        }
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
            }
            if($v['peerid'] == $userid){
                $v['type'] = 'zr';
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
            $v['date'] = date('m月d日');
            $v['time'] = date('H:i');
            if($v['userid'] == $userid){
                $v['type'] = 'zc';
            }
            if($v['peerid'] == $userid){
                $v['type'] = 'zr';
            }
        }
        echo json_encode($res);
    }


}