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
	* ���
	*
	* $key string ��
	* $value string ֵ
	* $time int �룬��Ч��
	*/
	public function addItem($key,$value,$time = 300){
		self::$_m->add($key,$value,$time);
	}
	
	/**
	* �޸�
	*
	* $key string ��
	* $value string ֵ
	* $time int �룬��Ч��
	*/
	public function repItem($key, $value, $time = 300){
		self::$_m->replace($key, $value, $time);
	}
	
	/**
	* �����ݲ����ڵ�ʱ���½������ڵ�ʱ�򣬸���
	*
	* $key string ��
	* $value string ֵ
	* $time int �룬��Ч��
	*/
	public function setItem($key, $value, $time = 300){
		self::$_m->set($key, $value, $time);
	}
	
	/**
	* ɾ��
	*
	* $key string ��
	*/
	public function delItem($key){
		self::$_m->delete($key);
	}
	
	/**
	* ȡֵ
	*
	* $key string ��
	*/
	public function getItem($key){
		return self::$_m->get($key);
	}
	
	
	
}