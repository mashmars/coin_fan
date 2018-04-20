<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Controller\BaseController;
class SystemController extends BaseController {
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