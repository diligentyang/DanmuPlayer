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
	/*
	function getAllvideo(){
		$pdo = \lib\Factory::GetMySQL();
		$data = $pdo->query("(select * from video where cid =1 ORDER BY id desc limit 2) union (select * from video where cid =2 ORDER BY id desc limit 2)");
		return $data;
	}
	*/
	function getAllvideo($cid,$limit){
		$pdo = \lib\Factory::GetMySQL();
		$data = $pdo->query("select A.id,cid,title,picpath,num,count(danmulist.id) as danmunum from (select * from video where cid=$cid ORDER BY id desc limit $limit) as A left JOIN danmulist on A.id = danmulist.vid GROUP BY A.id order by id desc; ");
		return $data;
	}
	
	function getRankList($limit){
		$pdo = \lib\Factory::GetMySQL();
		$data = $pdo->query("select A.id,cid,title,picpath,num,count(danmulist.id) as danmunum from (select * from video) as A left JOIN danmulist on A.id = danmulist.vid GROUP BY A.id order by danmunum desc,id desc limit $limit; ");
		return $data;
	}
	
}