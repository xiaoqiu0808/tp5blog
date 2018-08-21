<?php
namespace app\xiaoqiu\controller;
use think\Request;

class Index extends \app\xiaoqiu\controller\Common
{
    public function index()
    {
        return view('Index/index');
    }

    public function info()
    {
    	$configModel = model('ConfigModel');
    	$data = $configModel->getOne();
    	$error = '';
    	if(Request::instance()->isPOST())
    	{
    		if(!$data)
    		{
    			if($configModel->insert() === false)
	    		{
	    			$error = '修改失败';
	    		}
    		}
    		else
    		{
    			if($configModel->updates() === false)
    			{
    				$error = '修改失败';
    			}
    		}

    		if($error)
    		{
    			$this->error($error);
    		}

    		$this->success('修改成功');
    		exit;
    	}

    	$this->assign('data', $data);
    	return view('Index/info');
    }

    public function pass()
    {
    	$adminModel = model('AdminModel');
    	$userinfo = $adminModel->getOne(session('USER')['username']);

    	if(!$userinfo)
    	{
    		$this->error('非法操作');
    	}
    	if(Request::instance()->isPOST())
    	{
    		$data = $adminModel->updates();
    		if($data['status'] == 0){
    			$this->success($data['msg']);
    		}
    		else
    		{
    			$this->error($data['msg']);
    		}
    		exit;
    	}

    	$this->assign('data', $userinfo);
    	return view('Index/pass');
    }
}
