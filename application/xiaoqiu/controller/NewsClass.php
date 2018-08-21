<?php

namespace app\xiaoqiu\controller;
use think\Request;

class NewsClass extends Common
{
	public function index()
	{
		$newsClassModel = model('NewsClassModel');
		$ncData = setIndex($newsClassModel->getAll());
		$ncDataT = getTree($ncData);
		$this->assign('ncData', $ncData);
		$this->assign('ncDataT', $ncDataT);
		return view('NewsClass/index');
	}

	public function add()
	{
		$newsClassModel = model('NewsClassModel');
		if(Request::instance()->isPOST())
		{
			if($newsClassModel->insert() === false)
			{
				$this->error('添加失败');
			}

			$this->success('添加成功', url('NewsClass/index'));
			exit;
		}

		$ncData = $newsClassModel->getAll();
		$ncData = getTree($ncData);
		$this->assign('ncData', $ncData);
		$this->assign('artext', '添加');
		return view('NewsClass/add');
	}

	public function edit($id = 0)
	{
		$newsClassModel = model('NewsClassModel');
		if(Request::instance()->isPOST())
		{
			if($newsClassModel->updates($id) === false)
			{
				$this->error('修改失败');
			}

			$this->success('修改成功', url('NewsClass/index'));
			exit;
		}

		$this->assign('data', $newsClassModel->getOne($id));
		$ncData = $newsClassModel->getAll();
		$ncData = getTree($ncData);
		$this->assign('ncData', $ncData);
		$this->assign('artext', '修改');
		return view('NewsClass/add');
	}

	public function del($id = 0)
	{
		$newsClassModel = model('NewsClassModel');
		$data = $newsClassModel->del($id);
		if($data['status'] == 0)
		{
			$this->success($data['msg'], url('NewsClass/index'));
		}
		else
		{
			$this->error($data['msg']);
		}
	}
}