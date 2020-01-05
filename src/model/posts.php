<?php
class post{
	
	private $id;
	private $ip;
	
	public $nickname;
	public $time;
	public $uploadedpicurl;
	public $netimageurl;
	public $textcontent;
	private static $mongodbinstance=null;//mongodb to store.
	
	private static $redisinstance = null;//redis to store.
	
	
	public function __construct(){
		require_once '../db/mongodb.php';
		self::$mongodbinstance=new mongodb();
		
		self::$redisinstance = new Redis();
		if(self::$redisinstance != null){
			$coninfo = self::$redisinstance->connect('127.0.0.1',6379,2);//2 seconds is conect timeout.
		}
	}
	
	public function getIp(){
		return $this->ip;
	}
	public function setIp($ip){
		$this->ip = $ip;
		return true;
	}
	
	
	public function getOnePostById($id){
		
		$result = self::$mongodbinstance -> findOnePostById($id);
		return $result;
	}
	
	public function getAllPosts(){
	
		if(self::$redisinstance != null){
			
			try {
				$allResults = self::$redisinstance->get("allposts");
				if($allResults != null){
					return $allResults;
				}
			} catch (Exception $e) {
			}
		}
		
		$result = self::$mongodbinstance -> findAllPosts();
		try {
			self::$redisinstance->set("allposts",$result);
		} catch (Exception $e) {
		}
		return $result;
	}
	
	public function getOnePostByNickName($nickname){
		
		$result = self::$mongodbinstance -> findOnePostByNickName($nickname);
		return $result;
	}
	
	
	
	
	public function addOnePost($data){
		//add new post;
		$result = self::$mongodbinstance->addone($data);
		
		if($result != null){
			try {
				self::$redisinstance->set("allposts",null);
			} catch (Exception $e) {
			}
		}
		return $result;
		
		//return [nickname,time,context];
	}
	
	
}













