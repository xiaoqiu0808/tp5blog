<?php

namespace app\xiaoqiu\model;
use think\Model;
use think\Db;

class ArticleModel extends Model
{
	public function getAll($where = '')
	{
		return Db::name('article')->order('sort asc')->where($where)/*->fetchSql()*/->paginate(9);
	}

	public function getOne($id = 0)
	{
		return Db::name('article')->find($id);
	}

	public function insert()
	{
		$data = input('post.');
		$data['addtime'] = strtotime($data['addtime']);
		return Db::name('article')->insert( $data );
	}

	public function ajaxUpdate()
	{
		$data = input('get.');
		$key = key($data);
		$id = $data[$key];
		unset($data[$key]);
		return Db::name('article')->where(array('id'=>array('in', $id)))->update($data);
	}

	public function setSort()
	{
		$str = array();
		$data = array();
		$arr = input('get.');
		foreach($arr['id'] as $k=>$v)
		{
			$data['id']		= $v;
			$data['sort']	= $arr['sort'][$k];
			$str[] = Db::name('article')->update($data);
		}
		if(count($arr['id']) == count($str))
		{
			return true;
			exit;
		}

		return false;
	}

	public function updates()
	{
		$data = input('post.');
		$data['ishome'] = empty($data['ishome'])?0:1;
		$data['isvouch'] = empty($data['isvouch'])?0:1;
		$data['istop'] = empty($data['istop'])?0:1;

		return Db::name('article')->update($data);
	}

	public function del($id = 0)
	{
		return Db::name('article')->delete($id);
	}
}