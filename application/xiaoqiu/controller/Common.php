<?php

namespace app\xiaoqiu\controller;
use think\Controller;

class Common extends controller
{
	public function _initialize()
	{
		if(!session('USER.id') || !session('USER.username'))
		{
			$this->success('登陆超时，请重新登陆', url('Login/login'));
		}
	}
}