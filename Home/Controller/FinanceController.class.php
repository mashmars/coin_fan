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
        $this->display();
    }


}