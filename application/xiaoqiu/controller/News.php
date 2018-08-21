<?php

namespace app\xiaoqiu\controller;
use think\Request;

class News extends Common
{
	public function index()
	{
		$newsModel = model('NewsModel');
		$this->assign('data', $newsModel->getAll());

		$newsClassModel = model('NewsClassModel');
		$this->assign('ncData', setIndex($newsClassModel->getAll()));
		return view('News/index');
	}

	public function add()
	{
		if(Request::instance()->isPOST())
		{
			$newsModel = model('NewsModel');
			if($newsModel->insert() === false)
			{
				$this->error('添加失败');
			}

			$this->success('添加成功', url('News/index'));
			exit;
		}
		$newsClassModel = model('NewsClassModel');
		$nsData = getTree($newsClassModel->getAll());
		$this->assign('nsData', $nsData);
		$this->assign('tartxt', '添加');
		return view('News/add');
	}

	public function edit($id = 0)
	{
		$newsModel = model('NewsModel');
		if(Request::instance()->isPOST())
		{
			if($newsModel->updates() === false)
			{
				$this->error('修改失败');
			}

			$this->success('修改成功', url('News/index'));
			exit;
		}

		$this->assign('data', $newsModel->getOne($id));
		$newsClassModel = model('NewsClassModel');
		$this->assign('nsData', getTree($newsClassModel->getAll()));
		$this->assign('tartxt', '修改');
		return view('News/add');
	}

	public function del($id = 0)
	{
		$newsModel = model('NewsModel');
		if($newsModel->del($id) === false)
		{
			$this->error('删除失败');
		}

		$this->success('删除成功', url('News/index'));
	}
}