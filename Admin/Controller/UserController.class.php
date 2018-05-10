<?php
namespace Admin\Controller;

use Think\Controller;
use Admin\Controller\BaseController;
use Think\Upload;
class UserController extends BaseController
{	
	

    public function member_list()
    {	

        if(IS_POST){
            $data = I('post.');
            $field = $data['field'];
            $value = $data['keyword'];
            $res = M('user')->where(array($field=>$value))->select();
            $this->assign('res',$res);
            $this->assign('field',$field);
            $this->assign('keyword',$value);
            $this->display();
            exit;
		}else{
			$p = I('param.p', 1);
			$list = 10;
			$res = M('user')->page($p . ',' . $list)->order('id desc')->select();
			$count = M('user')->count();
			$page = new \Think\Page($count, $list);
			$show = $page->show();
			$this->assign('res', $res);
			$this->assign('page', $show);
			$this->assign('count', $count);
			$this->display();
		}
       
    }
	
	/*用户信息*/
	public function ajax_member_add(){
		$data = I('post.');
        //密码加密
        if($data['password'] == '' || $data['paypassword'] == '' || $data['phone'] == ''){
            echo ajax_return(0,'登录密码和支付密码,手机号不能为空');exit;
        }
        $data['password'] = md5($data['password']);
        $data['paypassword'] = md5($data['paypassword']);

		//判断上级用户名 手机号 不存在
        $phone = $data['phone'];
        $exist = M('user')->where(array('phone'=>$phone))->find();
        if($exist){
            echo ajax_return(0,'手机号已存在');exit;
        }
        //判断上级是否存在
        $upname = $data['refer'];
        if($upname){
            $id = M('user')->where(array('phone'=>$upname))->getField('id');
            if($id){
                $data['pid'] = $id;
            }else{
                echo ajax_return(0,'指定的推荐人手机号不存在');exit;
            }
        }else{
            $data['pid'] = 0;
        }
        //当前时间
        $data['createdate'] = $data['createdate'] ? strtotime($data['createdate']) : time();
        $data['username'] = $data['phone'];
        //区设置
        $zone = $data['zone'];

        //去掉
        unset($data['refer']);
        unset($data['zone']);
        $mo = M();
        $mo->startTrans();
        $rs = array();
        //注册成功
        $rs[] = $mo->table('user')->add($data);
        //插入资产表
        $rs[] = $mo->table('user_coin')->add(array('userid'=>$rs[0]));
        //开始分区
        $rs[] = $this->user_zone($rs[0],$data['pid'],$data['pid'],$zone);

        if(check_arr($rs)){
            $mo->commit();
            echo ajax_return(1,'注册成功');
        }else{
            $mo->rollback();
            echo ajax_return(0,'注册失败');
        }
	}

    /**
     * 注册分区 规则如下
     * 注册的时候选择A区或B区，如果是A区，则放到下级的A区上，
     */
    private  function user_zone($userid,$ownid,$pid,$zone)
    {
        if($pid == 0){
            $res = M('user_zone')->add(array('userid'=>$userid,'ownid'=>0,'pid'=>0,'zone'=>0));

        }else{
            $res = $this->add_zone($userid,$ownid,$zone,$pid,$zone);

        }
        if(!$res){
            return false;
        }
        return true;
    }
    /**
     *判断上级的该区是否有人，如果没有人，满足条件直接分配上  如果有人，则遍历下级的一区是否有人 没人则满足条件分配上
     * （考虑个特殊情况，如果分配的是2区，要先判断同级的1区是否有安排人，没有则直接安排上不用再遍历下级了）
     * 如果同级的1区有人，则遍历属于这个人下级且是2区的下级1区是否有人，没人则分配安排上
     * 加行锁 防止同时两个人挂一个人下面的情况
     * $userid 注册会员id $ownid 推荐人id $init_zone注册选择的分区 $pid 节点人的id $zone 要找的哪个区 遍历用
     */
    private function add_zone($userid,$ownid,$init_zone,$pid,$zone)
    {

        $info = M('user_zone')->where(array('pid'=>$pid,'zone'=>$zone))->lock(true)->find();
        if(!$info){
            $res = M('user_zone')->add(array('userid'=>$userid,'ownid'=>$ownid,'pid'=>$pid,'zone'=>$zone));
            if(!$res){
                return false;
            }
            return true;

        }else{

            if($init_zone == 2){
                $init_zone =1 ; //保证只找最初的一次
                //同级的一区是否有人 特殊情况
                $yiqu = M('user_zone')->where(array('pid'=>$pid,'zone'=>1))->lock(true)->find();
                if(!$yiqu){
                    $res = M('user_zone')->add(array('userid'=>$userid,'ownid'=>$ownid,'pid'=>$pid,'zone'=>1));
                    if(!$res){
                        return false;
                    }
                    return true;
                }
            }
            //遍历
            return $this->add_zone($userid,$ownid,$init_zone,$info['userid'],1);
        }
    }



	public function member_edit(){
		$id = I('param.id');
		$info = M('user')->where("id=$id")->find();
		$this->assign('info',$info);
		$this->display();
	}
	public function ajax_member_edit(){
		$data = I('post.');
		$id = $data['id'];
		unset($data['id']);
		if(!$data['realname']){
			echo ajax_return(0,'姓名不能为空');exit;
		}
		if($data['password']){
		    $data['password'] = md5($data['password']);
        }else{
		    unset($data['password']);
        }
        if($data['paypassword']){
            $data['paypassword'] = md5($data['paypassword']);
        }else{
            unset($data['paypassword']);
        }
        $data['createdate'] = $data['createdate'] ? strtotime($data['createdate']) : time();
		$res = M('user')->where("id=$id")->save($data);
		if($res){
			echo ajax_return(1,'编辑成功');
		}else{
			echo ajax_return(0,'编辑失败');
		}
	}
	//TODO:是否删除资产
	public function ajax_user_delete(){
		$id = I('post.id');
		$res = M('users')->where("id=$id")->delete();
		if($res){
			echo ajax_return(1,'删除成功');
		}else{
			echo ajax_return(0,'删除失败');
		}
	}

	//资产管理
    public function member_coin(){
        if(IS_POST){
            $data = I('post.');
            $field = $data['field'];
            $value = $data['keyword'];
            $res = M('user')->where(array($field=>$value))->find();
            if(!$res){
                $this->error('手机号不存在');exit;
            }
            $res = M('user_coin')->alias('a')->join('left join user b on a.userid=b.id')->where(array('b.id'=>$res['id']))->field('a.*,b.username,b.phone')->select();
            $this->assign('res',$res);
            $this->assign('field',$field);
            $this->assign('keyword',$value);
            $this->display();
            exit;
        }else{
            $list = 10;
            $p = I('param.p',1);

            $res = M('user_coin')->alias('a')->join('left join user b on a.userid=b.id')->field('a.*,b.username,b.phone')->page($p . ',' .$list)->select();
            $count = M('user_coin')->count();
            $page = new \Think\Page($count,$list);
            $show = $page->show();

            $this->assign('res',$res);
            $this->assign('page',$show);
            $this->assign('count',$count);

            $this->display();
        }
    }

    //资产编辑
    public function member_coin_edit______(){
	    $id = I('param.id');
	    $info = M('user_coin')->alias('a')->join('left join user b on a.userid=b.id')->where(array('a.id'=>$id))->field('a.*,b.username,b.phone')->find();
	    $this->assign('info',$info);
	    $this->display();
    }
    //资产编辑提交
    public function ajax_member_coin_edit____(){
	    $data = I('post.');
	    $res = M('user_coin')->save($data);
	    if($res){
            echo ajax_return(1,'更新成功');
        }else{
	        echo ajax_return(0,'更新失败');
        }
    }


    //充值
    public function member_chongzhi(){
        if(IS_POST){
            $data = I('post.');
            $field = $data['field'];
            $value = $data['keyword'];
            $res = M('user')->where(array($field=>$value))->find();
            if(!$res){
                $this->error('手机号不存在');exit;
            }
            $res = M('mycz')->alias('a')->join('left join user b on a.userid=b.id')->where(array('b.id'=>$res['id']))->field('a.*,b.username,b.phone')->select();
            $this->assign('res',$res);
            $this->assign('field',$field);
            $this->assign('keyword',$value);
            $this->display();
            exit;
        }else{
            $list = 10;
            $p = I('param.p',1);

            $res = M('mycz')->alias('a')->join('left join user b on a.userid=b.id')->field('a.*,b.username,b.phone')->page($p . ',' .$list)->select();
            $count = M('mycz')->count();
            $page = new \Think\Page($count,$list);
            $show = $page->show();

            $this->assign('res',$res);
            $this->assign('page',$show);
            $this->assign('count',$count);

            $this->display();
        }
    }
    public function ajax_member_chongzhi()
    {
        $phone = I('post.phone');
        $num = I('post.num');
        if($num <= 0 || !is_numeric($num)){
            echo ajax_return(0,'充值数量不正确');exit;
        }
        $id = M('user')->where(array('phone'=>$phone))->getField('id');
        if(!$id){
            echo ajax_return(0,'手机号不正确');exit;
        }
        $mo = M();
        $mo->startTrans();
        $rs = array();

        $rs[] = $mo->table('user_coin')->where(array('userid'=>$id))->setInc('lth',$num);
        $rs[] = $mo->table('mycz')->add(array(
            'userid'    => $id,
            'num'   =>$num,
            'createdate'    =>time()
        ));

        if(check_arr($rs)){
            $mo->commit();
            echo ajax_return(1,'充值成功');exit;
        }else{
            $mo->rollback();
            echo ajax_return(0,'充值失败');exit;
        }
    }


    /**
     * 我的团队
     */
    public function team()
    {
        $users = M('user_zone')->alias('a')->join('left join user b on a.userid=b.id')->field('a.*,b.phone')->where('a.pid=0')->select();
        $data = '';
        foreach($users as $user){
            $data .= $this->get_team($user['userid'],$user['phone']);
        }

       // $data = $this->get_team($userid);
        $data = '{"name":"我的团队","children":[' . $data;
        $data .= ']}';
        $this->assign('data',$data);
        $this->display();
    }
    public function get_team($userid,$phone='',$new=true)
    {
        static $data = '';
        if($new){
            $data = '';
        }
        $users = M('user_zone')->alias('a')->join('left join user b on a.userid=b.id')->where(array('a.pid'=>$userid))->field('a.*,b.phone')->select();
        if($users[0]) {
            foreach ($users as $user) {
                if ($user) {
                    //有下级
                    $data .= '{"name":"' . $user['phone'] . '","children":[';
                    $this->get_team($user['userid'],$user['phone'],false);
                    $data .= ']},';
                }/*else{
                //没有下级
                $data .= '{"name":"'.$user['phone'].'"},';
            }*/
            }
        }else{
            //没有下级
            if($new){
                $data .= '{"name":"'. $phone .'"},';
            }
        }
        return $data;
    }
	
	/*
	*
	*/
	public function tree(){
		/*
		<span><i class="icon-folder-open"></i> Parent</span>
		<ul>
			<li>
				<span><i class="icon-leaf"></i> Grand Child</span>
			</li>
			<li>
				<span><i class="icon-minus-sign"></i> Child</span>
				<ul>
					<li>
						<span><i class="icon-leaf"></i> Grand Child</span>
					</li>
				</ul>
			</li>
		</ul>	
		*/
		
		$html = '<span><i class="icon-folder-open"></i> 会员结构</span><ul>';
		
		$users = M('user_zone')->alias('a')->join('left join user b on a.userid=b.id')->field('a.*,b.phone,b.realname')->where('a.pid=0')->select();
		foreach($users as $user){
            $html .= $this->get_team1($user['userid'],$user['realname']);
        }
		$html .= '</ul>';
		
		$this->assign('html',$html);
		$this->display();
	}
	
	public function get_team1($userid,$phone='',$new=true)
    {
        static $data = '';
        if($new){
            $data = '';
        } 
		
        $users = M('user_zone')->alias('a')->join('left join user b on a.userid=b.id')->where(array('a.pid'=>$userid))->field('a.*,b.phone,b.realname')->select();
		//$total = $this->get_xiaji($userid);
		//$coin = M('user_coin')->where(array('userid'=>$userid))->getField('lth');
        if($users[0]) {
            foreach ($users as $user) {
                if ($user) {
                    //有下级
                    $data .= '<li><span><i class="icon-minus-sign"></i> '.$phone.'</span><ul>';
                    $this->get_team1($user['userid'],$user['realname'],false);
                    $data .= '</ul></li>';
                }
            }
        }else{
            //没有下级
            if($new){
                $data .= '<li><span><i class="icon-leaf"></i> '.$phone.'-'.$coin.'-'.$total.'</span></li>';
            }
        }
        return $data;
    }
	/*//获取两条线
	public function get_xiaji($userid)
	{
		$users = M('user_zone')->where(array('pid'=>$userid))->getField('userid',true);
		
		//第一个区
		if($users[0]){
			$users_a = $this->get_small_zone($users[0]);
			$qu_1_total = M('user_coin')->where(array('userid'=>array('in',$users_a)))->sum('lth');
		}
		
		//第二个区
		if($users[1]){
			$users_b = $this->get_small_zone($users[1]);
			$qu_2_total = M('user_coin')->where(array('userid'=>array('in',$users_b)))->sum('lth');
		}
		
		$total = $qu_1_total + $qu_2_total;
		
		return $total*1;
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
	}*/
	
}