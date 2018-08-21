<?php
namespace app\index\controller;

class Index extends Common
{
    public function index()
    {

    	//获取首页最新发布文章
    	$ishome = $this->articleModel->getIshome();
    	$this->assign('ishome', $ishome);

    	//获取友情链接
    	$linksModel = model('LinksModel');
    	$this->assign('links', $linksModel->getAll());
        return view('Index/index');
    }
}
