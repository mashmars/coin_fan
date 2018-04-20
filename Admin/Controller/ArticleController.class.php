<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Controller\BaseController;

class ArticleController extends BaseController {
    
	/******公告管理******/
    public function gonggao(){
        $article = M('article');
        $p = I('param.p',1);
        $page_list = 10;
        $list = $article->where('cate_id=1')->page($p.','.$page_list)->select();
        
        $this->assign('res',$list);//
        $count      = $article->count();//
        $Page       = new \Think\Page($count,$page_list);//
        $show       = $Page->show();//
        $this->assign('page',$show);
        $this->display();
    }
   
    //
    public function gonggao_add(){
        
        if(IS_POST){
            $data = I('post.');
            if($data['createdate']){
                $data['createdate'] = strtotime($data['createdate']);
            }else{
                $data['createdate'] = time();
            }
			$data['cate_id'] = 1;
            $res = M('article')->add($data);
            if($res){
                $this->success('添加成功',U('article/gonggao'),2);
            }else{
                $this->error('添加失败','',2);
            }
        }
        $this->display();
    }
    //编辑
    public function gonggao_edit(){
        $id = I('param.id');
        $info = M('article')->where("id=$id")->find();
        

        $this->assign('info' , $info);
       
        if(IS_POST){
            $data = I('post.');
            $id = $data['id'];
            if($data['createdate']){
                $data['createdate'] = strtotime($data['createdate']);
            }else{
                $data['createdate'] = time();
            }
            $res = M('article')->where("id=$id")->save($data);
            if($res){
                $this->success('修改成功',U('article/gonggao'),2);
            }else{
                $this->error('修改失败','',2);
            }
        }
        $this->display();
    }

    //更改状态时
    public function ajax_gonggao_status(){
        $id = I('post.id');
        $status = I('post.status');
        $res = M('article')->where("id=$id")->setField('status',$status);
        if($res){
            echo ajax_return(1,'修改成功');
        }else{
            echo ajax_return(0,'修改失败');
        }
    }
    //删除
    public function ajax_gonggao_del(){
        $id = I('post.id');
        $res = M('article')->where("id=$id")->delete();
        if($res){
            echo ajax_return(1,'删除成功');
        }else{
            echo ajax_return(0,'删除失败');
        }
    }
	
	/******买家管理******/
    public function buyer(){
        $article = M('article');
        $p = I('param.p',1);
        $page_list = 10;
        $list = $article->where('cate_id=2')->page($p.','.$page_list)->select();
        
        $this->assign('res',$list);//
        $count      = $article->count();//
        $Page       = new \Think\Page($count,$page_list);//
        $show       = $Page->show();//
        $this->assign('page',$show);
        $this->display();
    }
   
    //
    public function buyer_add(){
        
        if(IS_POST){
            $data = I('post.');
            if($data['createdate']){
                $data['createdate'] = strtotime($data['createdate']);
            }else{
                $data['createdate'] = time();
            }
			$data['cate_id'] = 2;
            $res = M('article')->add($data);
            if($res){
                $this->success('添加成功',U('article/buyer'),2);
            }else{
                $this->error('添加失败','',2);
            }
        }
        $this->display();
    }
    //编辑
    public function buyer_edit(){
        $id = I('param.id');
        $info = M('article')->where("id=$id")->find();
        

        $this->assign('info' , $info);
       
        if(IS_POST){
            $data = I('post.');
            $id = $data['id'];
            if($data['createdate']){
                $data['createdate'] = strtotime($data['createdate']);
            }else{
                $data['createdate'] = time();
            }
            $res = M('article')->where("id=$id")->save($data);
            if($res){
                $this->success('修改成功',U('article/buyer'),2);
            }else{
                $this->error('修改失败','',2);
            }
        }
        $this->display();
    }

    //更改状态时
    public function ajax_buyer_status(){
        $id = I('post.id');
        $status = I('post.status');
        $res = M('article')->where("id=$id")->setField('status',$status);
        if($res){
            echo ajax_return(1,'修改成功');
        }else{
            echo ajax_return(0,'修改失败');
        }
    }
    //删除
    public function ajax_buyer_del(){
        $id = I('post.id');
        $res = M('article')->where("id=$id")->delete();
        if($res){
            echo ajax_return(1,'删除成功');
        }else{
            echo ajax_return(0,'删除失败');
        }
    }
	
	/******卖家管理******/
    public function seller(){
        $article = M('article');
        $p = I('param.p',1);
        $page_list = 10;
        $list = $article->where('cate_id=3')->page($p.','.$page_list)->select();
        
        $this->assign('res',$list);//
        $count      = $article->count();//
        $Page       = new \Think\Page($count,$page_list);//
        $show       = $Page->show();//
        $this->assign('page',$show);
        $this->display();
    }
   
    //
    public function seller_add(){
        
        if(IS_POST){
            $data = I('post.');
            if($data['createdate']){
                $data['createdate'] = strtotime($data['createdate']);
            }else{
                $data['createdate'] = time();
            }
			$data['cate_id'] = 3;
            $res = M('article')->add($data);
            if($res){
                $this->success('添加成功',U('article/seller'),2);
            }else{
                $this->error('添加失败','',2);
            }
        }
        $this->display();
    }
    //编辑
    public function seller_edit(){
        $id = I('param.id');
        $info = M('article')->where("id=$id")->find();
        

        $this->assign('info' , $info);
       
        if(IS_POST){
            $data = I('post.');
            $id = $data['id'];
            if($data['createdate']){
                $data['createdate'] = strtotime($data['createdate']);
            }else{
                $data['createdate'] = time();
            }
            $res = M('article')->where("id=$id")->save($data);
            if($res){
                $this->success('修改成功',U('article/seller'),2);
            }else{
                $this->error('修改失败','',2);
            }
        }
        $this->display();
    }

    //更改状态时
    public function ajax_seller_status(){
        $id = I('post.id');
        $status = I('post.status');
        $res = M('article')->where("id=$id")->setField('status',$status);
        if($res){
            echo ajax_return(1,'修改成功');
        }else{
            echo ajax_return(0,'修改失败');
        }
    }
    //删除
    public function ajax_seller_del(){
        $id = I('post.id');
        $res = M('article')->where("id=$id")->delete();
        if($res){
            echo ajax_return(1,'删除成功');
        }else{
            echo ajax_return(0,'删除失败');
        }
    }
	
	/******规则管理******/
    public function rule(){
        $article = M('article');
        $p = I('param.p',1);
        $page_list = 10;
        $list = $article->where('cate_id=4')->page($p.','.$page_list)->select();
        
        $this->assign('res',$list);//
        $count      = $article->count();//
        $Page       = new \Think\Page($count,$page_list);//
        $show       = $Page->show();//
        $this->assign('page',$show);
        $this->display();
    }
   
    //
    public function rule_add(){
        
        if(IS_POST){
            $data = I('post.');
            if($data['createdate']){
                $data['createdate'] = strtotime($data['createdate']);
            }else{
                $data['createdate'] = time();
            }
			$data['cate_id'] = 4;
            $res = M('article')->add($data);
            if($res){
                $this->success('添加成功',U('article/rule'),2);
            }else{
                $this->error('添加失败','',2);
            }
        }
        $this->display();
    }
    //编辑
    public function rule_edit(){
        $id = I('param.id');
        $info = M('article')->where("id=$id")->find();
        

        $this->assign('info' , $info);
       
        if(IS_POST){
            $data = I('post.');
            $id = $data['id'];
            if($data['createdate']){
                $data['createdate'] = strtotime($data['createdate']);
            }else{
                $data['createdate'] = time();
            }
            $res = M('article')->where("id=$id")->save($data);
            if($res){
                $this->success('修改成功',U('article/rule'),2);
            }else{
                $this->error('修改失败','',2);
            }
        }
        $this->display();
    }

    //更改状态时
    public function ajax_rule_status(){
        $id = I('post.id');
        $status = I('post.status');
        $res = M('article')->where("id=$id")->setField('status',$status);
        if($res){
            echo ajax_return(1,'修改成功');
        }else{
            echo ajax_return(0,'修改失败');
        }
    }
    //删除
    public function ajax_rule_del(){
        $id = I('post.id');
        $res = M('article')->where("id=$id")->delete();
        if($res){
            echo ajax_return(1,'删除成功');
        }else{
            echo ajax_return(0,'删除失败');
        }
    }
	
	/******交易安全管理******/
    public function security(){
        $article = M('article');
        $p = I('param.p',1);
        $page_list = 10;
        $list = $article->where('cate_id=5')->page($p.','.$page_list)->select();
        
        $this->assign('res',$list);//
        $count      = $article->count();//
        $Page       = new \Think\Page($count,$page_list);//
        $show       = $Page->show();//
        $this->assign('page',$show);
        $this->display();
    }
   
    //
    public function security_add(){
        
        if(IS_POST){
            $data = I('post.');
            if($data['createdate']){
                $data['createdate'] = strtotime($data['createdate']);
            }else{
                $data['createdate'] = time();
            }
			$data['cate_id'] = 5;
            $res = M('article')->add($data);
            if($res){
                $this->success('添加成功',U('article/security'),2);
            }else{
                $this->error('添加失败','',2);
            }
        }
        $this->display();
    }
    //编辑
    public function security_edit(){
        $id = I('param.id');
        $info = M('article')->where("id=$id")->find();
        

        $this->assign('info' , $info);
       
        if(IS_POST){
            $data = I('post.');
            $id = $data['id'];
            if($data['createdate']){
                $data['createdate'] = strtotime($data['createdate']);
            }else{
                $data['createdate'] = time();
            }
            $res = M('article')->where("id=$id")->save($data);
            if($res){
                $this->success('修改成功',U('article/security'),2);
            }else{
                $this->error('修改失败','',2);
            }
        }
        $this->display();
    }

    //更改状态时
    public function ajax_security_status(){
        $id = I('post.id');
        $status = I('post.status');
        $res = M('article')->where("id=$id")->setField('status',$status);
        if($res){
            echo ajax_return(1,'修改成功');
        }else{
            echo ajax_return(0,'修改失败');
        }
    }
    //删除
    public function ajax_security_del(){
        $id = I('post.id');
        $res = M('article')->where("id=$id")->delete();
        if($res){
            echo ajax_return(1,'删除成功');
        }else{
            echo ajax_return(0,'删除失败');
        }
    }
	
	/*******单页面*****/
	//关于我们
    public function s_about(){
        $cate_id=6;
        $info = M('article')->where("cate_id=$cate_id")->find();
        

        $this->assign('info' , $info);
       
        if(IS_POST){
            $data = I('post.');
            $res = M('article')->where("cate_id=$cate_id")->save($data);
            if($res){
                $this->success('修改成功',U('article/s_about'),2);
            }else{
                $this->error('修改失败','',2);
            }
        }
        $this->display();
    }
	//联系我们
    public function s_contact(){
        $cate_id=7;
        $info = M('article')->where("cate_id=$cate_id")->find();
        

        $this->assign('info' , $info);
       
        if(IS_POST){
            $data = I('post.');
            $res = M('article')->where("cate_id=$cate_id")->save($data);
            if($res){
                $this->success('修改成功',U('article/s_contact'),2);
            }else{
                $this->error('修改失败','',2);
            }
        }
        $this->display();
    }
	//法律声明
    public function s_shengming(){
        $cate_id=8;
        $info = M('article')->where("cate_id=$cate_id")->find();
        

        $this->assign('info' , $info);
       
        if(IS_POST){
            $data = I('post.');
            $res = M('article')->where("cate_id=$cate_id")->save($data);
            if($res){
                $this->success('修改成功',U('article/s_shengming'),2);
            }else{
                $this->error('修改失败','',2);
            }
        }
        $this->display();
    }
	//使用协议
    public function s_xieyi(){
        $cate_id=9;
        $info = M('article')->where("cate_id=$cate_id")->find();
        

        $this->assign('info' , $info);
       
        if(IS_POST){
            $data = I('post.');
            $res = M('article')->where("cate_id=$cate_id")->save($data);
            if($res){
                $this->success('修改成功',U('article/s_xieyi'),2);
            }else{
                $this->error('修改失败','',2);
            }
        }
        $this->display();
    }
	//版权隐私
    public function s_yinsi(){
        $cate_id=10;
        $info = M('article')->where("cate_id=$cate_id")->find();
        

        $this->assign('info' , $info);
       
        if(IS_POST){
            $data = I('post.');
            $res = M('article')->where("cate_id=$cate_id")->save($data);
            if($res){
                $this->success('修改成功',U('article/s_yinsi'),2);
            }else{
                $this->error('修改失败','',2);
            }
        }
        $this->display();
    }
	
}