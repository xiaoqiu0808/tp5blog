<?php

namespace app\index\model;
use think\Model;
use think\Db;

class LinksModel extends Model
{
	public function getAll()
	{
		return Db::name('Links')->select();
	}
}