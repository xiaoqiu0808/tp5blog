<?php

namespace app\xiaoqiu\model;
use think\Model;
use think\Db;

class ConfigModel extends Model
{
	public function insert()
	{
		return Db::name('config')->insert(input('post.'));
	}

	public function getOne()
	{
		return Db::name('config')->find();
	}

	public function updates()
	{
		return Db::name('config')->update(input('post.'));
	}
}