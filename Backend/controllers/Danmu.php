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
		$vid = $this->segment(3);
		$pdo = \lib\Factory::GetMySQL();
		$data = $pdo->query("select content from danmulist where vid = $vid");
		$arr = [];
		foreach($data as $val){
			$arr[] = $val['content'];
		}
		//var_dump($arr);
		echo json_encode($arr);
	}

    function actionTest()
    {
        $data = array("id"=>'1',"name"=>'ysy');

        $model = $this->model('TestModel');
        $model->testModelMethod();
        $model->aaa();
        $passwd = new \lib\Password();
        echo $passwd->generatePasswordHash("222222");
        $this->view("request", $data);
    }
}