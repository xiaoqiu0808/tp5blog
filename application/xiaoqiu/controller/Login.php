<?php

namespace app\xiaoqiu\controller;
use think\Controller;
use think\Request;

class Login extends Controller
{
	public function login()
	{
		if(Request::instance()->isPOST())
		{
			if(!captcha_check(input('post.code')))
			{
				$this->error('验证码错误');
			}
			$adminModel = model('AdminModel');
			$data = $adminModel->getOne();

			if($data['status'] == 1 || $data['status'] == 2)
			{
				$this->error($data['msg']);
			}
			if($data['status'] == 0)
			{
				$this->success($data['msg'], url('Index/index'));
			}
			exit;
		}
		return view();
	}

	public function outlogin()
	{
		session('USER','');
		session_destroy();
		$this->success('注销成功', url('Login/login'));
		exit;
	}
}