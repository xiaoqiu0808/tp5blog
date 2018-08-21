<?php

namespace app\xiaoqiu\model;

use think\Model;
use think\Db;

class AdminModel extends Model
{
	public function updates()
	{
		$mpass = input('post.mpass');
		$password = input('post.newpass');
		$renewpass = input('post.renewpass');
		$id = input('post.id');
		$data = array();
		if($password != $renewpass)
		{
			$data = array(
				'status'	=> 2,
				'msg'		=> '新密码与确认密码不一致'
			);
			return $data;
			exit;
		}
		$admin = Db::name('admin');

		$userinfo = $admin->find($id);

		if($userinfo['password'] != md5($mpass))
		{
			$data = array(
				'status'	=> 1,
				'msg'		=> '原始密码错误',
			);

			return $data;
			exit;
		}

		if($admin->where('id', $id)->setField('password', md5($password)) === false)
		{
			$data = array(
				'status'	=> 3,
				'msg'		=> '原始密码错误',
			);
		}
		else
		{
			$data = array(
				'status'	=> 0,
				'msg'		=> '修改成功',
			);
		}

		return $data;
	}
	public function getOne($user = '')
	{
		//$username = input('post.username');
		//$password = input('post.password');
		$data = array();
		$username = input('post.username')?:$user;
		//获取数据
		$userinfo = Db::name('admin')->where('username', $username)->find();
		if($user)
		{
			unset($userinfo['password']);
			return $userinfo;
			exit;
		}


		if(!$userinfo)
		{
			$data = array(
				'status'	=> 1,
				'msg'		=> '用户名或密码错误！'
			);
		}

		if( $userinfo['password'] != md5(input('post.password')) )
		{
			$data = array(
				'status'	=> 2,
				'msg'		=> '用户名或密码错误！'
			);
		}
		else
		{
			unset($userinfo['password']);
			session('USER', $userinfo);
			$data = array(
				'status'	=> 0,
				'msg'		=> '登陆成功'
			);
		}

		return $data;
	}
}