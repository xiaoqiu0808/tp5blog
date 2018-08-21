<?php

namespace app\index\model;
use think\Model;
use think\Db;

class NewsModel extends Model
{
	public function getOne($nc_id = 0)
	{
		return Db::name('News')->where('nc_id',$nc_id)->find();
	}
}