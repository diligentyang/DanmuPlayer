<?php
namespace lib\NoSql;
use \systems\DYBaseFunc as DYBaseFunc;

class Memcache
{
	private static $_m = null;
	private static $_cache = null;
	
	private function __construct($ip,$port){
		self::$_m = new \Memcache();
		self::$_m->connect($ip,$port); 
	}
	
	public static function getInstance($ip,$port){
		
		if(!self::$_cache){
            self::$_cache = new self($ip,$port);
        }
        return self::$_cache;
	}
	
	private function __clone(){
		DYBaseFunc::showErrors("Object cannot be cloned!");
	}
	
	/**
	* 添加
	*
	* $key string 键
	* $value string 值
	* $time int 秒，有效期
	*/
	public function setItem($key,$value,$time = 300){
		self::$_m->add($key,$value,$time);
	}
	
	/**
	* 修改
	*
	* $key string 键
	* $value string 值
	* $time int 秒，有效期
	*/
	public function repItem($key, $value, $time = 300){
		self::$_m->replace($key, $value, $time);
	}
	
}