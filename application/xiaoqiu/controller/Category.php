<?php

namespace app\xiaoqiu\controller;
use think\Request;

class Category extends \app\xiaoqiu\controller\Common
{
	public function index()
	{
		$categoryModel = model('CategoryModel');
		$data = $categoryModel->getAll();
		$datas = setIndex($data);

		$this->assign('datas', $datas);

		$data = getTree($data);
		$this->assign('data', $data);
		return view('Category/index');
	}

	public function add()
	{
		$categoryModel = model('CategoryModel');

		if(Request::instance()->isPOST())
		{
			if($categoryModel->insert() === false)
			{
				$this->error('添加失败');
			}
			$this->success('添加成功', url('index'));
			exit;
		}
		$data = $categoryModel->getAll();
		$data = getTree($data);
		$this->assign('data', $data);
		return view('Category/add');
	}

	public function edit($id = 0)
	{
		$categoryModel = model('CategoryModel');

		if(Request::instance()->isPOST())
		{
			if($categoryModel->updates() === false)
			{
				$this->error('修改失败');
			}
			$this->success('修改成功', url('Category/index'));
			exit;
		}
		$data = $categoryModel->getAll();
		$data = getTree($data);
		$this->assign('data', $data);
		$this->assign('catedata', $categoryModel->getOne($id));
		return view('Category/add');
	}

	public function del($id = 0)
	{
		$categoryModel = model('CategoryModel');

		if($categoryModel->getOne($id, 'pid'))
		{
			$this->error('该分类有子分类，请先删除所有子分类');
		}

		if($categoryModel->del($id) === false)
		{
			$this->error('删除失败');
		}

		$this->success('删除成功', url('Category/index'));
	}
}