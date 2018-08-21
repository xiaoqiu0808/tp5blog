<?php

namespace app\xiaoqiu\model;
use think\Model;
use think\Db;

class NewsModel extends Model
{
	public function getAll()
	{
		return Db::name('News')->select();
	}

	public function getOne($id = 0)
	{
		return Db::name('News')->find($id);
	}

	public function insert()
	{
		$data = input('post.');
		$data['posttime'] = strtotime($data['posttime']);
		return Db::name('News')->insert($data);
	}

	public function updates()
	{
		#var_dump(input('post.'));exit;
		return Db::name('News')->update(input('post.'));
	}

	public function del($id = 0)
	{
		return Db::name('News')->delete($id);
	}
}