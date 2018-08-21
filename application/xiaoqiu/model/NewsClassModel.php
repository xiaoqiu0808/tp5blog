<?php

namespace app\xiaoqiu\model;
use think\Model;
use think\Db;

class NewsClassModel extends Model
{
	public function getAll()
	{
		return Db::name('newsClass')->select();
	}

	public function getOne($id = 0)
	{
		return Db::name('newsClass')->find($id);
	}

	public function insert()
	{
		return Db::name('newsClass')->insert(input('post.'));
	}

	public function updates($id = 0)
	{
		return Db::name('newsClass')->where('id',$id)->update(input('post.'));
	}

	public function del($id = 0)
	{
		$model = Db::name('newsClass');
		if($model->where('pid',$id)->find())
		{
			return $data = array('status'=>1, 'msg'=>'请先删除该分类的子类');
			exit;
		}

		if($model->delete($id) === false)
		{
			return $data = array('status'=>2, 'msg'=>'删除失败');
			exit;
		}

		return $data = array('status'=>0, 'msg'=>'删除成功');
	}
}