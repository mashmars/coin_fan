<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
use Admin\Controller\BaseController;
class AuthController extends BaseController {
    public function admin_list(){
		$admin = M('admin')->alias('a')->join('left join admin_auth_group_access b on a.id=b.uid')->join('left join admin_auth_group c on b.group_id=c.id')->field('a.*,c.title')->select();
		$this->assign('admin' , $admin);
		$this->display();
	}
	public function admin_add(){
		$role = M('admin_auth_group')->field('id,title')->select();
		$this->assign('role',$role);
		$this->display();
	}
	public function ajax_admin_add(){
		$username = I('post.username');
		$descript = I('post.descript');
		$pwd = I('post.pwd');
		$pwd2 = I('post.pwd2');
		$group_id = I('post.group_id');
		if($username == ''){
			echo json_encode(array('info'=>'error','msg'=>'管理员用户名不能为空'));
			exit;
		}
		if($pwd == '' || $pwd2 == ''){
			echo json_encode(array('info'=>'error','msg'=>'初始密码和确认密码不能为空'));
			exit;
		}
		if($pwd != $pwd2){
			echo json_encode(array('info'=>'error','msg'=>'初始密码和确认密码不一致'));
			exit;
		}
		if($group_id == ''){
			echo json_encode(array('info'=>'error','msg'=>'请选择管理员的角色'));
			exit;
		}
		$data['username'] = $username;
		$data['descript'] = $descript;
		$data['pwd'] = md5($pwd);
		$id = M('admin')->add($data);
		if($id){
			///绑定group_id
			$group['uid'] = $id;
			$group['group_id'] = $group_id;
			M('admin_auth_group_access')->add($group);
			echo json_encode(array('info'=>'success','msg'=>'管理员新增成功'));
		}else{
			echo json_encode(array('info'=>'error','msg'=>'管理员新增失败'));
		}
	}
	public function admin_edit(){
		$id = I('param.id');
		$info = M('admin')->alias('a')->join('left join admin_auth_group_access b on a.id=b.uid')->field('a.*,b.group_id')->where("a.id=$id")->find();
		$this->assign('info',$info);
		//角色列表
		$role = M('admin_auth_group')->field('id,title')->select();
		$this->assign('role',$role);
		$this->display();
	}
	public function ajax_admin_edit(){
		$uid = I('post.id');
		$username = I('post.username');
		$descript = I('post.descript');
		$pwd = I('post.pwd');
		$pwd2 = I('post.pwd2');
		$group_id = I('post.group_id');
		if($username == ''){
			echo json_encode(array('info'=>'error','msg'=>'管理员用户名不能为空'));
			exit;
		}
		
		if($group_id == ''){
			echo json_encode(array('info'=>'error','msg'=>'请选择管理员的角色'));
			exit;
		}
		$data['username'] = $username;
		$data['descript'] = $descript;
		if($pwd != '' || $pwd2 != ''){
			if($pwd == '' || $pwd2 == ''){
				echo json_encode(array('info'=>'error','msg'=>'初始密码和确认密码不能为空'));
				exit;
			}
			if($pwd != $pwd2){
				echo json_encode(array('info'=>'error','msg'=>'初始密码和确认密码不一致'));
				exit;
			}
			$data['pwd'] = md5($pwd); //存在修改密码
		}
		
		$id = M('admin')->where("id=$uid")->setField($data);
		if($id){
			///绑定group_id
			$group['uid'] = $uid;
			$group['group_id'] = $group_id;
			M('admin_auth_group_access')->where("uid=$uid")->save($group);
			echo json_encode(array('info'=>'success','msg'=>'管理员编辑成功'));
		}else{
			echo json_encode(array('info'=>'error','msg'=>'管理员编辑失败'));
		}
	}
	public function admin_del(){
		$id = I('post.id');
		$res = M('admin')->where("id=$id")->delete();
		if($res){
			//删除admin_auth_group_access关联
			M('admin_auth_group_access')->where("uid=$id")->delete();
			echo json_encode(array('info'=>'success','msg'=>'删除成功'));
		}else{
			echo json_encode(array('info'=>'error','msg'=>'删除失败'));
		}
	}
	//////////角色管理
	public function admin_role(){
		$role = M('admin_auth_group')->select();
		$this->assign('role',$role);
		$this->display();
	}
	public function admin_role_add(){
		
		$this->display();
	}
	//添加角色
	public function ajax_role_add(){
		
		$title = I('post.title');
		
		$data['title'] = $title;
		
		$id = M('admin_auth_group')->add($data);
		if($id){
			echo json_encode(array('info'=>'success','msg'=>'添加成功'));
		}else{
			echo json_encode(array('info'=>'error','msg'=>'添加失败'));
		}
	}
	public function admin_role_edit(){
		$id = I('param.id');
		$info = M('admin_auth_group')->where("id=$id")->field('id,title')->find();
		$this->assign('info' , $info);
		$this->display();
	}
	public function ajax_role_edit(){
		
		$title = I('post.title');
		$id = I('post.id');
		$data['title'] = $title;
		
		$id = M('admin_auth_group')->where("id=$id")->setField($data);
		if($id){
			echo json_encode(array('info'=>'success','msg'=>'修改成功'));
		}else{
			echo json_encode(array('info'=>'error','msg'=>'修改失败'));
		}
	}
	public function ajax_role_del(){
		$id = I('post.id');
		$res = M('admin_auth_group')->where("id=$id")->delete();
		if($res){
			//删除角色后，应该也把用户此角色id的中间表记录也删除
			M('admin_auth_group_access')->where("group_id=$id")->delete();
			echo json_encode(array('info'=>'success','msg'=>'删除成功'));
		}else{
			echo json_encode(array('info'=>'error','msg'=>'删除失败'));
		}
	}
	//查看角色权限
	public function admin_role_view(){
		$id = I('param.id'); //角色id
		$role = M('admin_auth_group')->where("id=$id")->find();//角色名字
		//菜单列表
		$menu = M('admin_auth_rule')->where('pid=0')->select();
		foreach($menu as &$v){
			$erji = M("admin_auth_rule")->where("cengji=2 and pid=".$v['id'])->select();
			foreach($erji as &$vv){
				$sanji = M("admin_auth_rule")->where("cengji=3 and pid=".$vv['id'])->select();
				$vv['sanji'] = $sanji;
			}
			$v['erji'] = $erji;
		}
       
        $this->assign('menu' , $menu);//echo '<pre>';var_dump($menu);exit;
		$this->assign('role',$role);
		$this->assign('id',$id);
		$this->display();
	}
	//角色分配权限
	public function admin_role_grant(){
		$id = I('param.id'); //角色id
		$role = M('admin_auth_group')->where("id=$id")->find();//角色名字
		//菜单列表
		$menu = M('admin_auth_rule')->where('pid=0')->select();
		foreach($menu as &$v){
			$erji = M("admin_auth_rule")->where("cengji=2 and pid=".$v['id'])->select();
			foreach($erji as &$vv){
				$sanji = M("admin_auth_rule")->where("cengji=3 and pid=".$vv['id'])->select();
				$vv['sanji'] = $sanji;
			}
			$v['erji'] = $erji;
		}
       
        $this->assign('menu' , $menu);//echo '<pre>';var_dump($menu);exit;
		$this->assign('role',$role);
		$this->assign('id',$id);
		$this->display();
	}
	public function ajax_role_grant(){
		$rules = I('post.rules');
		if(is_array($rules)){
			$rules = implode(',',$rules);
		}		
		$id = I('post.id');
		$res = M('admin_auth_group')->where("id=$id")->setField('rules',$rules);
		if($res){
			echo json_encode(array('info'=>'success','msg'=>'分配成功'));
		}else{
			echo json_encode(array('info'=>'error','msg'=>'分配失败'));
		}
	}
	public function admin_menu(){
		$menu = M('admin_auth_rule')->select();      
        $menu = list_level($menu);
       
        $this->assign('menu' , $menu);
		//var_dump($menu);
		$this->display();
	}
	public function admin_menu_add(){
		$menu = M('admin_auth_rule')->select();      
        $menu = list_level($menu);
       
        $this->assign('menu' , $menu);
	    
		$this->display();
	}
	//添加菜单
	public function ajax_menu_add(){
		$pid = I('post.pid');
		$title = I('post.title');
		$controller = I('post.controller');
		$action = I('post.action');
		//层级 菜单层级
		$cengji = M('admin_auth_rule')->where("id=$pid")->getField('cengji');
		if(!$cengji){
			$cengji=0;
		}
		if($cengji <= 2){
			$data['cengji'] = $cengji + 1; 
		}else{var_dump(1);
			echo json_encode(array('info'=>'error','msg'=>'上级菜单只能是一级菜单或二级菜单'));
			exit;
		}
		$data['pid'] = $pid;
		$data['name'] = ucfirst($controller) . '/' . ucfirst($action) ;
		$data['title'] = $title;
		$data['controller'] = ucfirst($controller);
		$data['action'] = ucfirst($action);
		
		$id = M('admin_auth_rule')->add($data);
		if($id){
			echo json_encode(array('info'=>'success','msg'=>'添加成功'));
		}else{
			echo json_encode(array('info'=>'error','msg'=>'添加失败'));
		}
	}
	public function admin_menu_edit(){
		$menu = M('admin_auth_rule')->select();      
        $menu = list_level($menu);
       
        $this->assign('menu' , $menu);
		
		$id = I('param.id');
		$info = M('admin_auth_rule')->where("id=$id")->find();
		$this->assign('info' ,$info);
		$this->display();
	}
	public function ajax_menu_edit(){
		$id = I('post.id');
		$pid = I('post.pid');
		$title = I('post.title');
		$controller = I('post.controller');
		$action = I('post.action');
		///不能选择自己作为上级
		if($pid == $id){
			echo json_encode(array('info'=>'error','msg'=>'不能选择自己作为上级菜单'));
			exit;
		}
		//层级 菜单层级
		$cengji = M('admin_auth_rule')->where("id=$pid")->getField('cengji');
		if(!$cengji){
			$cengji=0;
		}
		if($cengji <= 2){
			$data['cengji'] = $cengji + 1;
		}else{
			echo json_encode(array('info'=>'error','msg'=>'上级菜单只能是一级菜单或二级菜单'));
			exit;
		}
		$data['pid'] = $pid;
		$data['name'] = ucfirst($controller) . '/' . ucfirst($action) ;
		$data['title'] = $title;
		$data['controller'] = ucfirst($controller);
		$data['action'] = ucfirst($action);
		
		$id = M('admin_auth_rule')->where("id=$id")->setField($data);
		if($id){
			echo json_encode(array('info'=>'success','msg'=>'添加成功'));
		}else{
			echo json_encode(array('info'=>'error','msg'=>'添加失败'));
		}
	}
	public function ajax_menu_del(){
		$id = I('post.id');
		$res = M('admin_auth_rule')->where("id=$id")->delete();
		if($res){
			echo json_encode(array('info'=>'success','msg'=>'删除成功'));
		}else{
			echo json_encode(array('info'=>'error','msg'=>'删除失败'));
		}
	}
	
}