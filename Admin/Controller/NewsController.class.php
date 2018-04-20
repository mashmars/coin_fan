<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Controller\BaseController;
class NewsController extends BaseController {
	/*求职需求*/
	public function job_list(){
		$p = I('param.p', 1);
        $list = 10;
        $res = M('job')->page($p . ',' . $list)->order('id desc')->select();
        
        $count = M('job')->count();
        $page = new \Think\Page($count, $list);
        $show = $page->show();
        $this->assign('res', $res);
        $this->assign('page', $show);
        $this->assign('count', $count);
        $this->display();
	}
	//删除
    public function ajax_job_del(){
        $id = I('post.id');
        $res = M('job')->where("id=$id")->delete();
        if($res){
            echo ajax_return(1,'删除成功');
        }else{
            echo ajax_return(0,'删除失败');
        }
    }
	
    /**公告管理*/
    public function gonggao_list(){
        $article = M('news');
        $p = I('param.p',1);
        $page_list = 10;
        $list = $article->alias('a')->order('a.id desc')->field('a.*')->page($p.','.$page_list)->select();

        $this->assign('res',$list);//
        $count      = $article->count();//
        $Page       = new \Think\Page($count,$page_list);//
        $show       = $Page->show();//
        $this->assign('page',$show);
        $this->display();
    }

    public function gonggao_add(){

        if(IS_POST){
            $data = I('post.');
            if(!$data['createdate']){
				$data['createdate'] = time();
			}else{
				$data['createdate'] =strtotime($data['createdate']);
			}
			
            $res = M('news')->add($data);
            if($res){
                $this->success('添加成功',U('news/gonggao_list'),2);
            }else{
                $this->error('添加失败','',2);
            }
        }
        $this->display();
    }
    //编辑
    public function gonggao_edit(){
        $id = I('param.id');
        $info = M('news')->where("id=$id")->find();
        $this->assign('info',$info);
        if(IS_POST){
            $data = I('post.');
            $id = $data['id'];
            ///
			if(!$data['createdate']){
				$data['createdate'] = time();
			}else{
				$data['createdate'] =strtotime($data['createdate']);
			}
            $res = M('news')->where("id=$id")->save($data);
            if($res){
                $this->success('修改成功',U('news/gonggao_list'),2);
            }else{
                $this->error('修改失败','',2);
            }
        }
        $this->display();
    }

    //删除
    public function ajax_gonggao_del(){
        $id = I('post.id');
        $res = M('news')->where("id=$id")->delete();
        if($res){
            echo ajax_return(1,'删除成功');
        }else{
            echo ajax_return(0,'删除失败');
        }
    }
}