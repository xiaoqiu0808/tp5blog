<?php

namespace app\common\model;
use think\Model;
use think\Db;

class ArticleModel extends Model
{
	public function getAll($cid = 0)
	{
		return Db::name('article')->where(array('cid'=>array('in',$cid)))->order('addtime desc')->select();
	}

	public function getOne($id = 0)
	{
		return Db::name('article')->find($id);
	}

	public function getIsvouch($isvouch = 'isvouch')
	{
		return Db::name('article')->where(array('ishome'=>1, $isvouch=>1))->limit(6)->order('addtime desc')->select();
	}

	public function getIshome()
	{
		return Db::name('article')->where(array('ishome'=>1))->limit(10)->order("addtime desc")->select();
	}
}