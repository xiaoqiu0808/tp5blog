<?php

namespace app\index\Model;
use think\Model;
use think\Db;

class ConfigModel extends Model
{
	public function getOne()
	{
		return Db::name('config')->find();
	}
}