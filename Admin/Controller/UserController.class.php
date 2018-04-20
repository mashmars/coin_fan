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
        if($data['password'] == ''){
            echo ajax_return(0,'登录密码不能为空');exit;
        }
        $data['password'] = md5($data['password']);

		//判断上级用户名 手机号 不存在
        $username = $data['username'];
        $phone = $data['phone'];

        $map['username'] = $username;
        $map['phone'] = $phone;
        $map['_logic'] = 'OR';

        $exist = M('user')->where($map)->find();
        if($exist){
            echo ajax_return(0,'用户名或手机号已存在');exit;
        }

        //判断上级是否存在
        $upname = $data['pid'];
        if($upname){
            $id = M('user')->where(array('username'=>$upname))->getField('id');
            if($id){
                $data['pid'] = $id;
            }else{
                echo ajax_return(0,'指定的上级用户名不存在');exit;
            }
        }else{
            $data['pid'] = 0;
        }
        //当前时间
        $data['createdate'] = $data['createdate'] ? strtotime($data['createdate']) : time();



		$res = M('user')->add($data);
		if($res){
		    //同时建立用户资产
            M('user_coin')->add(array('userid'=>$res));
			echo ajax_return(1,'添加成功');
		}else{
			echo ajax_return(0,'添加失败');
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

    //资产编辑
    public function member_coin_edit(){
	    $id = I('param.id');
	    $info = M('user_coin')->alias('a')->join('left join user b on a.userid=b.id')->where(array('a.id'=>$id))->field('a.*,b.username,b.phone')->find();
	    $this->assign('info',$info);
	    $this->display();
    }
    //资产编辑提交
    public function ajax_member_coin_edit(){
	    $data = I('post.');
	    $res = M('user_coin')->save($data);
	    if($res){
            echo ajax_return(1,'更新成功');
        }else{
	        echo ajax_return(0,'更新失败');
        }
    }

	
}