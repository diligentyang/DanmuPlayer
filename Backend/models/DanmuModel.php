<?php
namespace models;

defined('ACCESS') OR exit('No direct script access allowed');

Class DanmuModel extends \systems\DYModel
{
    function __construct()
    {

    }

    function stoneByVid($vid,$content)
    {
        $pdo = \lib\Factory::GetMySQL();
		date_default_timezone_set('PRC');
		$addtime = date("Y-m-d H:i:s");
		$arr = [
			'vid'=>$vid,
			'content'=>$content,
			'addtime'=>$addtime
		];
		$res = $pdo->insert("danmulist",$arr);
    }
	
	function selectByVid($vid){
		$pdo = \lib\Factory::GetMySQL();
		$data = $pdo->query("select content from danmulist where vid = $vid");
		$arr = [];
		foreach($data as $val){
			$arr[] = $val['content'];
		}
		return $arr;
	}
}