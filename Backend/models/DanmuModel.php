<?php
namespace models;

defined('ACCESS') OR exit('No direct script access allowed');

Class DanmuModel extends \systems\DYModel
{
    function __construct()
    {

    }

	//根据视频id添加弹幕
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
	
	//根据视频id查询弹幕
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
	//得到所有的视频
	function getAllvideo($cid,$limit){
		$pdo = \lib\Factory::GetMySQL();
		$data = $pdo->query("select A.id,cid,title,picpath,num,count(danmulist.id) as danmunum from (select * from video where cid=$cid ORDER BY id desc limit $limit) as A left JOIN danmulist on A.id = danmulist.vid GROUP BY A.id order by id desc; ");
		return $data;
	}
	
	//获取排行榜
	function getRankList($limit){
		$pdo = \lib\Factory::GetMySQL();
		$data = $pdo->query("select * from video order by num desc,id desc limit $limit; ");
		return $data;
	}
	
	//更新视频的浏览量
	function updateVideoNum($id){
		$pdo = \lib\Factory::GetMySQL();
		$res = $pdo->query("UPDATE `video` SET num=num+1 WHERE id=$id;");
		if($res){
			return true;
		}else{
			return false;
		}
	}
	
	//根据id获取视频详情
	function getVideoDetailById($id){
		$pdo = \lib\Factory::GetMySQL();
		$data = $pdo->query("select title,videopath,picpath,A.addtime,num,count(danmulist.id) as danmunum from (select * from video where id = $id )as A left JOIN danmulist on A.id=danmulist.vid GROUP BY A.id;");
		return $data;
	}
	
	//获取弹幕list
	function getDanmuListById($id){
		$pdo = \lib\Factory::GetMySQL();
		$data = $pdo->query("select * from danmulist where vid = $id order by vddtime limit 30;");
		return $data;
	}
	
	//得到弹幕总条数
	function getDanmuCount($id){
		$pdo = \lib\Factory::GetMySQL();
		$data = $pdo->query("select count(id)as danmucount from danmulist where vid = $id;");
		return $data;
	}
	
	//右侧推荐
	function getShowTuijian($limit){
		$pdo = \lib\Factory::GetMySQL();
		$data = $pdo->query("select A.id,cid,title,picpath,num,count(danmulist.id) as danmunum from (select * from video ORDER BY id desc limit $limit) as A left JOIN danmulist on A.id = danmulist.vid GROUP BY A.id order by id desc; ");
		return $data;
	}
	
	//得到指定数目的弹幕
	function getLimitDanmuListById($id,$start,$limit){
		$pdo = \lib\Factory::GetMySQL();
		$data = $pdo->query("select * from danmulist where vid = $id order by vddtime limit $start,$limit;");
		return $data;
	}
	
}