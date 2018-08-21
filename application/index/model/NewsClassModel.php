<?php

namespace app\index\model;
use think\Model;
use think\Db;

class NewsClassModel extends Model
{
	public function getAll()
	{
		return Db::name('NewsClass')->select();
	}
}