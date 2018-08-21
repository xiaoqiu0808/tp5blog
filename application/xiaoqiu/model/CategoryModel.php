<?php

namespace app\xiaoqiu\model;
use think\Model;
use think\Db;

class CategoryModel extends Model
{
	/**
	 * 获取所有数据
	 * @return [复合类型] [返回]
	 */
	public function getAll()
	{
		return Db::name('category')->select();
	}

	public function insert()
	{
		return Db::name('category')->insertGetId(input('post.'));
	}

	public function getOne($id = 0, $index = 'id')
	{
		return Db::name('category')->where(array($index=>$id))->find();
	}

	public function updates()
	{
		return db('category')->update(input('post.'));
	}

	public function del($id = 0)
	{
		return db('category')->delete($id);
	}
}