<?php
namespace controllers;

class Danmu extends \systems\DYController
{
    public function actionStone()
    {
		$model = $this->model("DanmuModel");
		$vid = $this->segment(3);
		$content = $_POST['danmu'];
		$model->stoneByVid($vid,$content);
    }
	
	public function actionQuery(){
		header('Access-Control-Allow-Origin:*');  
		$model = $this->model("DanmuModel");
		$vid = $this->segment(3);
		$arr = $model->selectByVid($vid);
		//var_dump($arr);
		echo json_encode($arr);
	}

	//获取首页的video列表
    function actionGetvideo()
    {
	   $callback = $_GET['callback'];
	   $model = $this->model("DanmuModel");
	   $arr1 = $model->getAllvideo(1,8);
	   $arr2 = $model->getAllvideo(2,8);
	   $arr3 = $model->getRankList(8);
	   echo $callback.'('.json_encode([$arr1,$arr2,$arr3]).')';
    }
	
	//showvideo界面
	function actionShowvideo()
	{
		header('Access-Control-Allow-Origin:*');  
		//$callback = $_GET['callback'];
		$id = $_GET['id'];
		$model = $this->model("DanmuModel");
		$model->updateVideoNum($id);//更新浏览量
		$arr1 = $model->getVideoDetailById($id);//获取video信息
		$arr2 = $model->getDanmuListById($id);//获取弹幕列表的前30条
		$arr4 = $model->getDanmuCount($id);//获取弹幕总个数
		$arr3 = $model->getShowTuijian(5);//获取推荐
		echo json_encode([$arr1,$arr2,$arr3,$arr4]);
		//echo $callback.'('.json_encode([$arr1]).')';
		
	}
	
	//获取弹幕list，每次加载15个
	function actionGetlimitdanmu()
	{
		$callback = $_GET['callback'];
		$id = $_GET['id'];
		$start = $_GET['num'];
		$limit = 15;
		$model = $this->model("DanmuModel");
		$arr = $model->getLimitDanmuListById($id,$start,$limit);
		echo $callback.'('.json_encode([$arr]).')';
	}
	
	/*测试memcache*/
	function actionTestMem(){
		$m = \lib\Factory::getMemcache();
		$m->setItem("wsk","521",60);
		//var_dump($m->getItem("wsk1"));
		//$m->showStatus();
		//var_dump($m->flushAll());
	}
}