<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Controller\BaseController;
class SystemController extends BaseController {
	
	/**
	 *静态分红
	 */
	public function sys_jtfh()
	{
		$res = M('sys_jtfh')->order('id asc')->select();
		$this->assign('res',$res);
		$this->display();
	}
	public function ajax_sys_jtfh_add()
	{
		$min = I('post.minnum');
		$max = I('post.maxnum');
		$bl = I('post.bl');
		$status = I('post.status');
		if($min == '' || $max == '' || $min <=0 || $max <=0){
			echo ajax_return(0,'设置参数有误');exit;
		}
		//如果是第一条记录 不判断最大值最小值条件
		$count = M('sys_jtfh')->count();
		if($count > 0){
			//找到上一条记录
			$info = M('sys_jtfh')->order('id desc')->find();
			if($min <= $info['maxnum']){
				echo ajax_return(0,'临界点设置不正确');exit;
			}
			$res = M('sys_jtfh')->add(array('minnum'=>$min,'maxnum'=>$max,'bl'=>$bl,'status'=>$status));
		}else{
			$res = M('sys_jtfh')->add(array('minnum'=>$min,'maxnum'=>$max,'bl'=>$bl,'status'=>$status));
		}
		if($res){
			echo ajax_return(1,'添加成功');
		}else{
			echo ajax_return(0,'添加失败');
		}
	}
	public function sys_jtfh_edit()
	{
		$id = I('param.id');
		$info = M('sys_jtfh')->where(array('id'=>$id))->find();
		$this->assign('info',$info);
		$this->display();
	}
	public function ajax_sys_jtfh_edit()
	{
		$data = I('post.');
		$min = I('post.minnum');
		$max = I('post.maxnum');
		$bl = I('post.bl');
		$status = I('post.status');
		if($min == '' || $max == '' || $min <=0 || $max <=0 || $min >= $max){
			echo ajax_return(0,'设置参数有误');exit;
		}
		//如果是第一条记录 不判断最大值最小值条件
		$count = M('sys_jtfh')->count();
		if($count > 1){ //只有一条记录时不用判断
			//找到上一条记录
			$prev = M('sys_jtfh')->where(array('id'=>array('lt',$data['id'])))->find();
			if($min <= $prev['maxnum'] && $prev){ //必须满足有上一条记录才判断，第一条不用判断
				echo ajax_return(0,'最小值临界点设置不正确');exit;
			}
			//找到下一条记录
			$next = M('sys_jtfh')->where(array('id'=>array('gt',$data['id'])))->find();
			if($max >= $next['minnum'] && $next){ //必须满足有下一条记录才判断 最后一条不用判断
				echo ajax_return(0,'最大值临界点设置不正确');exit;
			}
			$res = M('sys_jtfh')->save($data);
		}else{
			$res = M('sys_jtfh')->save($data);
		}
		if($res){
			echo ajax_return(1,'修改成功');
		}else{
			echo ajax_return(0,'修改失败');
		}
	}
	public function ajax_sys_jtfh_del()
	{
		$id = I('post.id');
		$res = M('sys_jtfh')->delete($id);
		if($res){
			echo ajax_return(1,'删除成功');
		}else{
			echo ajax_return(0,'删除失败');
		}
	}
	
	/**
	 *动态分红
	 */
	public function sys_dtfh()
	{
		$res = M('sys_dtfh')->order('id asc')->select();
		$this->assign('res',$res);
		$this->display();
	}
	public function ajax_sys_dtfh_add()
	{
		$min = I('post.minnum');
		$max = I('post.maxnum');
		$bl = I('post.bl');
		$status = I('post.status');
		if($min == '' || $max == '' || $min <=0 || $max <=0){
			echo ajax_return(0,'设置参数有误');exit;
		}
		//如果是第一条记录 不判断最大值最小值条件
		$count = M('sys_dtfh')->count();
		if($count > 0){
			//找到上一条记录
			$info = M('sys_dtfh')->order('id desc')->find();
			if($min <= $info['maxnum']){
				echo ajax_return(0,'临界点设置不正确');exit;
			}
			$res = M('sys_dtfh')->add(array('minnum'=>$min,'maxnum'=>$max,'bl'=>$bl,'status'=>$status));
		}else{
			$res = M('sys_dtfh')->add(array('minnum'=>$min,'maxnum'=>$max,'bl'=>$bl,'status'=>$status));
		}
		if($res){
			echo ajax_return(1,'添加成功');
		}else{
			echo ajax_return(0,'添加失败');
		}
	}
	public function sys_dtfh_edit()
	{
		$id = I('param.id');
		$info = M('sys_dtfh')->where(array('id'=>$id))->find();
		$this->assign('info',$info);
		$this->display();
	}
	public function ajax_sys_dtfh_edit()
	{
		$data = I('post.');
		$min = I('post.minnum');
		$max = I('post.maxnum');
		$bl = I('post.bl');
		$status = I('post.status');
		if($min == '' || $max == '' || $min <=0 || $max <=0 || $min >= $max){
			echo ajax_return(0,'设置参数有误');exit;
		}
		//如果是第一条记录 不判断最大值最小值条件
		$count = M('sys_dtfh')->count();
		if($count > 1){ //只有一条记录时不用判断
			//找到上一条记录
			$prev = M('sys_dtfh')->where(array('id'=>array('lt',$data['id'])))->find();
			if($min <= $prev['maxnum'] && $prev){ //必须满足有上一条记录才判断，第一条不用判断
				echo ajax_return(0,'最小值临界点设置不正确');exit;
			}
			//找到下一条记录
			$next = M('sys_dtfh')->where(array('id'=>array('gt',$data['id'])))->find();
			if($max >= $next['minnum'] && $next){ //必须满足有下一条记录才判断 最后一条不用判断
				echo ajax_return(0,'最大值临界点设置不正确');exit;
			}
			$res = M('sys_dtfh')->save($data);
		}else{
			$res = M('sys_dtfh')->save($data);
		}
		if($res){
			echo ajax_return(1,'修改成功');
		}else{
			echo ajax_return(0,'修改失败');
		}
	}
	public function ajax_sys_dtfh_del()
	{
		$id = I('post.id');
		$res = M('sys_dtfh')->delete($id);
		if($res){
			echo ajax_return(1,'删除成功');
		}else{
			echo ajax_return(0,'删除失败');
		}
	}
	
	
	
	
	
	
	
////系统设置
    public function system_base(){
        $info = M('config')->where("id=1")->find();
        $this->assign('info' , $info);
        if(IS_POST){
            $data = I('post.');
            //上传图片
            if($_FILES['logo']['name']){
                $data['logo'] = upload_file(UP_SYSTEM,$_FILES['logo']);
            }else{
				$data['logo'] = $info['logo'];
			}
			//上传图片
            if($_FILES['banner']['name']){
                $data['banner'] = upload_file(UP_SYSTEM,$_FILES['banner']);
            }else{
				$data['banner'] = $info['banner'];
			}
            $temp = M('config')->where("id=1")->save($data) ;
            if($temp){
                $this->success('系统设置修改成功!',U('system/system_base'),1);
            }else{
                $this->error('系统设置修改失败!','',1);
            }
        }
        $this->display();
    }
    /////banner图
    public function banner(){
        $banner = M('banner')->select();
        $this->assign('banner' , $banner);
        $this->display();
    }
    public function banner_add(){
        if(IS_POST){
            $data = I('post.');
            //上传图片
            if($_FILES['image']['name']){
                $data['image'] = upload_file(UP_SYSTEM,$_FILES['image']);
            }

            if(M('banner')->add($data)){
                $this->success('轮播图新增成功!',U('system/banner'),1);
            }else{
                $this->error('轮播图新增失败!','',1);
            }

        }
        $this->display();
    }
    public function banner_edit(){
        $id = I('param.id');
        $info = M('banner')->where('id='.$id)->find();
        $this->assign('info' , $info);
        if(IS_POST){
            $data = I('post.');
            $id = $data['id'] ;
            unset($data['id']);
            //如果上传图片,如果上传 删除原图片   如果没有上传图片  保存此字段值不变
            $old_img = M('banner')->getFieldById( $id , 'image' );
            //上传图片
            if($_FILES['image']['name']){
                $data['image'] = upload_file(UP_SYSTEM,$_FILES['image']);
                //删除原图片
                unlink('.' . UP_SYSTEM . $old_img);
            }else{
                $data['image'] = $old_img;
            }

            if(M('banner')->where('id='.$id)->setField($data)){
                $this->success('编辑成功!' , U('system/banner') , 1) ;
            }else{
                $this->error('编辑失败!' , '', 1);
            }
        }
        $this->display();
    }
    public function banner_del(){
        $id = I('post.id');
        $image = M('banner')->where("id=$id")->field('image')->find();
        if(M('banner')->where("id=$id")->delete()){
            @unlink('.' . UP_SYSTEM  . $image['image'] );
            echo json_encode(array('msg'=>'已删除'));
        }else{
            echo json_encode(array('msg'=>'删除失败!'));
        }
    }
}