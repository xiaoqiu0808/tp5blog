<?php

namespace app\index\controller;

class Article extends Common
{
	public function index($id = 0)
	{
		$_GET['id'] = $id;
		$cid = getTree($this->cdata, $id);
		$cid = array_column($cid, 'id');
		$cid[] = $id;
		$articleData = $this->articleModel->getAll($cid);
		$this->assign('articleData', $articleData);
		return view('Article/index');
	}

	public function show($id = 0)
	{
		$this->assign('data', $this->articleModel->getOne($id));
		return view('Article/show');
	}
}