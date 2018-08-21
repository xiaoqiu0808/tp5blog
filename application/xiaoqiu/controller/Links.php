<?php

namespace app\xiaoqiu\controller;
use think\Request;

class Links extends Common
{
	public function index()
	{
		$linksModel = model('LinksModel');
		$this->assign('data', $linksModel->getAll());
		return view('Links/index');
	}

	public function add()
	{
		if(Request::instance()->isPost())
		{
			$linksModel = model('LinksModel');
			if($linksModel->insert() === false)
			{
				$this->error('添加失败');
			}

			$this->success('添加成功', url('Links/index'));
			exit;
		}

		$this->assign('artext', '添加');
		return view('Links/add');
	}

	public function edit($id = 0)
	{
		$linksModel = model('LinksModel');

		if(Request::instance()->isPost())
		{
			if($linksModel->updates() === false)
			{
				$this->error('修改失败');
			}

			$this->success('修改成功', url('Links/index'));
			exit;
		}

		$this->assign('data', $linksModel->getOne($id));
		$this->assign('artext', '修改');
		return view('Links/add');
	}

	public function del($id = 0)
	{
		$linksModel = model('LinksModel');
		if($linksModel->del($id) === false)
		{
			$this->error('删除失败');
		}

		$this->success('删除成功', url('Links/index'));
	}
}