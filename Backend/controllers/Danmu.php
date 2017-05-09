<?php
namespace controllers;

class Danmu extends \systems\DYController
{
    public function actionStone()
    {
		echo $this->segment(3);
		/*
        $pdo = \lib\Factory::GetMySQL();
		$content = $_POST['danmu'];
		$arr = [
			'vid'=>"1",
			'content'=>$content,
			'addtime'=>"2017-05-09 20:23:23"
		];
		$res = $pdo->insert("danmulist",$arr);
		var_dump($res);*/
    }
	
	public function actionQuery(){
		$pdo = \lib\Factory::GetMySQL();
		$data = $pdo->query("select * from danmulist");
		var_dump($data);
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