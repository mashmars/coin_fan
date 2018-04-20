<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Verify;
class LoginController extends Controller {
    
    public function login(){
        if(IS_POST){
            $user = I('post.username');
            $pwd = I('post.pwd');
            $captcha = I('post.captcha');
            /*//验证验证码
            $verify = new Verify();//实例化验证码类
            if(!$verify->check(I('post.captcha'))){
                $this->error('验证码错误','',1);
            }*/
            $users = M('admin');
            //通过user获取pwd
            $map['username'] = $user;
            $info = $users->where($map)->find(); 
            if(!$info){ //没有用户
                $this->error('用户名或密码错误','',1);
            }else{ //有用户
                if($info['pwd'] != md5($pwd)){ //输入的登录密码和数据库密码不一样
                    $this->error('用户名或密码错误','',1);
                }else{ // 验证通过
                    //开启session
                    session('adminid' , $info['id']);
                    session('admin' , $info['username']);
                    //保存上次登录的时间                 
                    session('log_ip', $info['last_log_ip']);
                    session('log_time', $info['last_log_time']);
                    //记录本次登录时间和ip
                    $data['last_log_ip'] = get_client_ip();
                    $data['last_log_time'] = time();
                    $map['id'] = $info['id'];
                    $id = $users->where($map)->save($data);
                    $this->redirect('/index/index');
                    //$this->redirect(U('index/index'));
                }
            }
        }
        $this->display();
    }
    public function captcha(){
        ob_clean();
        $config =    array(
            'fontSize'    =>    16,    // 验证码字体大小
            'length'      =>    3,     // 验证码位数
            'useNoise'    =>    false, // 关闭验证码杂点
        );
        $Verify =     new Verify($config);
        $Verify->entry();
    }
    
    public function logout(){
        session(null);
        echo json_encode(array('info'=>'success'));
    }
	public function ajax_change_pwd(){
		$old = I('post.old_pwd');
		$new = I('post.newpassword');
		$new2 = I('post.newpassword2');
		$uid = session('adminid');
		if($new =='' || $new2 == ''){
			echo json_encode(array('info'=>'error','msg'=>'新密码和确认密码不能为空'));exit;
		}
		if($new != $new2){
			echo json_encode(array('info'=>'error','msg'=>'新密码和确认密码不一致'));exit;
		}
		$info = M('admin')->where("id=$uid")->find();
		if($info['pwd'] != md5($old)){
			echo json_encode(array('info'=>'error','msg'=>'原始密码不正确'));exit;
		}
		$res = M('admin')->where("id=$uid")->setField('pwd',md5($new));
		if($res){
			echo json_encode(array('info'=>'success','msg'=>'修改成功'));exit;
		}else{
			echo json_encode(array('info'=>'error','msg'=>'修改失败'));exit;
		}
	}
}