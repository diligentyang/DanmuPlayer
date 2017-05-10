<?php
namespace controllers;

class Danmu extends \systems\DYController
{
    public function actionStone()
    {
		$vid = $this->segment(3);
        $pdo = \lib\Factory::GetMySQL();
		date_default_timezone_set('PRC');
		$addtime = date("Y-m-d H:i:s");
		$content = $_POST['danmu'];
		$arr = [
			'vid'=>$vid,
			'content'=>$content,
			'addtime'=>$addtime
		];
		$res = $pdo->insert("danmulist",$arr);
    }
	
	public function actionQuery(){
		$pdo = \lib\Factory::GetMySQL();
		$data = $pdo->query("select content from danmulist where vid = 1");
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