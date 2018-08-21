<?php

namespace app\index\controller;
use think\Controller;
use think\Url;

class Common extends Controller
{
	public $articleModel = '';
	public $cdata = '';
	public function _initialize()
	{
		Url::root('/index.php');
		$categoryModel = model('CategoryModel');
		$this->cdata = setIndex($categoryModel->getAll());

		foreach ($this->cdata as $v)
		{
			$nav2[$v['pid']][] = $v;
		}

		//导航
		$nav = array_filter($this->cdata, function($arr){
			return $arr['pid'] == 0;
		});
		$this->assign('nav', $nav);
		$this->assign('nav2', $nav2);
		$this->assign('cdata', $this->cdata);

		//获取配置信息
		$configModel = model('ConfigModel');
		$this->assign('configs', $configModel->getOne());


		$this->articleModel = model('ArticleModel');
		//获取首页与推荐文章
    	$isvouch = $this->articleModel->getIsvouch();
    	$this->assign('isvouch', $isvouch);
		//获取首页置顶文章
    	$istop = $this->articleModel->getIsvouch('istop');
    	$this->assign('istop', $istop);

    	//获取页脚导航信息
    	$NewsClassModel = model('NewsClassModel');
    	$footerTop = $NewsClassModel->getAll();
    	$data = array();
    	foreach ($footerTop as $k => $v)
    	{
    		$data[$v['pid']][] = $v;
    	}
    	$this->assign('footerTop', $data);
	}
}