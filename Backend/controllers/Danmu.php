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
	   $arr = $model->getAllvideo();
	   echo $callback.'('.json_encode($arr).')';
    }
}