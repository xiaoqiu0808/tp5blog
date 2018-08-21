<?php

namespace app\index\controller;

class About extends Common
{
	public function show($nc_id = 0)
	{
		$newsModel = model('NewsModel');
		$this->assign('data', $newsModel->getOne($nc_id) );
		return view('About/show');
	}
}