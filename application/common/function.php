<?php


/**
 * 无限级分类
 * @param  [array]  $data  [需要排序的数组]
 * @param  integer $pid    [父级id]
 * @param  integer $level  [层级]
 * @return [复合数据]      [返回值]
 */
function getTree($data, $pid = 0, $level = 0)
{
	static $arr = array();
	foreach ($data as $k => $v)
	{
		if($v['pid'] == $pid)
		{
			$v['level'] = $level;
			$arr[] = $v;
			unset($data[$k]);
			getTree($data, $v['id'], $level+1);
		}
	}

	return $arr;
}

function setIndex($data, $index='id')
{
	static $arr = array();
	foreach ($data as $k => $v)
	{
		$arr[ $v[$index] ] = $v;
	}

	return $arr;
}