<?php

namespace app\xiaoqiu\model;
use think\Model;
use think\Db;

class LinksModel extends Model
{
	public function getALl()
	{
		return Db::name('Links')->select();
	}

	public function getOne($id = 0)
	{
		return Db::name('Links')->find($id);
	}

	public function insert()
	{
		return Db::name('Links')->insert(input('post.'));
	}

	public function updates()
	{
		return Db::name('Links')->update(input('post.'));
	}

	public function del($id = 0)
	{
		return Db::name('Links')->delete($id);
	}
}