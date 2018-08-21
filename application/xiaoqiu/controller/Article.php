<?php

namespace app\xiaoqiu\controller;
use think\Request;
use think\File;

class Article extends \app\xiaoqiu\controller\Common
{
	public function index()
	{
		//var_dump(input('get.'));exit;
		$where = '';
		if($ishome = input('get.ishome'))
		{
			$where['ishome'] = $ishome;
		}

		if($isvouch = input('get.isvouch'))
		{
			$where['isvouch'] = $isvouch;
		}

		if($istop = input('get.istop'))
		{
			$where['istop'] = $istop;
		}

		if($cid = input('get.cid'))
		{
			$where['cid'] = $cid;
		}

		if($title = input('get.title'))
		{
			$where['title'] = array('like',"%{$title}%");
		}

		$categoryModel = model('CategoryModel');
		$data = setIndex($categoryModel->getAll());
		$this->assign('cdat', $data);

		$catdata = getTree($data);
		$this->assign('catdata', $catdata);

		$articleModel = model('ArticleModel');
		$list = $articleModel->getAll($where);
		$page = $list->render();
		$this->assign('page', $page);
		$this->assign('adata', $list);
		return view(Request::instance()->isAjax()?'ajaxIndex':'Article/index');
	}

	public function add()
	{
		if(Request::instance()->isPOST())
		{
			$articleModel = model('ArticleModel');
			if($articleModel->insert() === false)
			{
				$this->error('添加失败');
			}
			$this->success('添加成功', url('Article/index'));
			exit;
		}

		$categoryModel = model('CategoryModel');
		$this->assign('catdata', getTree( $categoryModel->getAll() ) );
		$this->assign('tartxt', '添加');
		return view('Article/add');
	}

	public function edit($id = 0)
	{
		$articleModel = model('ArticleModel');
		if(Request::instance()->isPOST())
		{
			if($articleModel->updates() === false)
			{
				$this->error('修改失败');
			}
			$this->success('修改成功', url('Article/index'));
			exit;
		}
		$this->assign('adata', $articleModel->getOne($id));
		$categoryModel = model('CategoryModel');
		$this->assign('catdata', getTree( $categoryModel->getAll() ) );
		$this->assign('tartxt', '编辑');
		return view('Article/add');
	}

	public function ajaxUpdate()
	{
		$articleModel = model('ArticleModel');
		if($articleModel->ajaxUpdate() === false)
		{
			$this->error('设置失败');
		}

		$this->success('设置成功', url('Article/index'));
	}

	public function setSort()
	{
		$articleModel = model('ArticleModel');
		if($articleModel->setSort() === false)
		{
			$this->error('设置排序失败');
		}

		$this->success('设置排序成功', url('Article/index'));
	}

	public function del($id = 0)
	{
		$articleModel = model('ArticleModel');
		if($articleModel->del($id) === false)
		{
			$this->error('删除失败');
		}

		$this->success('删除成功', url('Article/index'));
	}

	public function upload()
	{
	    // 获取表单上传文件 例如上传了001.jpg
	    $file = request()->file('file');
	    // 移动到框架应用根目录/public/uploads/ 目录下
	    $info = $file->validate(['size'=>3145728,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
	    if($info)
	    {
	        // 成功上传后 获取上传信息
	        // 输出 jpg
	       // echo $info->getExtension();
	        // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
	        echo json_encode($info->getSaveName());
	        // 输出 42a79759f284b767dfcb2a0197904287.jpg
	        //echo $info->getFilename();
	    }
	    else
	    {
	        // 上传失败获取错误信息
	        echo $file->getError();
	    }
	}
}
