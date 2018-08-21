<?php

namespace app\index\model;
use think\Model;
use think\Db;

class CategoryModel extends Model
{
	public function getAll()
	{
		return Db::name('category')->select();
	}
}
