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
		$v=json_decode($content);
		$vddtime = date("H:i:s",57600+round(+($v->time)/10));
		$addtime = date("Y-m-d H:i:s");
		$arr = [
			'vid'=>$vid,
			'content'=>$content,
			'addtime'=>$addtime,
			'vddtime'=>$vddtime
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
		$data = $pdo->query("select * from video order by num desc,id desc limit $limit; ");
		return $data;
	}
	
	function updateVideoNum($id){
		$pdo = \lib\Factory::GetMySQL();
		$res = $pdo->query("UPDATE `video` SET num=num+1 WHERE id=$id;");
		if($res){
			return true;
		}else{
			return false;
		}
	}
	
	function getVideoDetailById($id){
		$pdo = \lib\Factory::GetMySQL();
		$data = $pdo->query("select title,videopath,picpath,A.addtime,num,count(danmulist.id) as danmunum from (select * from video where id = $id )as A left JOIN danmulist on A.id=danmulist.vid GROUP BY A.id;");
		return $data;
	}
	
	function getDanmuListById($id){
		$pdo = \lib\Factory::GetMySQL();
		$data = $pdo->query("select * from danmulist where vid = $id order by vddtime limit 30;");
		return $data;
	}
	
	function getDanmuCount($id){
		$pdo = \lib\Factory::GetMySQL();
		$data = $pdo->query("select count(id)as danmucount from danmulist where vid = $id;");
		return $data;
	}
	
	function getShowTuijian($limit){
		$pdo = \lib\Factory::GetMySQL();
		$data = $pdo->query("select A.id,cid,title,picpath,num,count(danmulist.id) as danmunum from (select * from video ORDER BY id desc limit $limit) as A left JOIN danmulist on A.id = danmulist.vid GROUP BY A.id order by id desc; ");
		return $data;
	}
	
	function getLimitDanmuListById($id,$start,$limit){
		$pdo = \lib\Factory::GetMySQL();
		$data = $pdo->query("select * from danmulist where vid = $id order by vddtime limit $start,$limit;");
		return $data;
	}
	
}