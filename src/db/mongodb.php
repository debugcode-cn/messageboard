<?php

class mongodb{
	
	public function getcon(){
		
		$manager = new MongoDB\Driver\Manager("mongodb://myhome:myhome@127.0.0.1:12345/myhome");
		
		return $manager;
	}
	
	public function getFilter($fieldname,$fieldvalue){
		
		if(null == $fieldname){
			return [];
		}else if ($fieldname == '_id'){
			
			$f = [
				'_id' => new MongoDB\BSON\ObjectID($fieldvalue)
			];
		}else if ($fieldname == 'nickname'){
			$f = [
				'nickname' => $fieldvalue
			];
		}
		return $f;
		
	}
	public function getOptions(){
		// fan hui id ,to bind id in html tag.
		return
		[
			'projection' => [
					'_id'=>1,
					'ip'=>1,
					'time'=>1,
					'nickname'=>1,
					'textcontent'=>1
			],
		];
	}
	
	public function findOnePostById($id){
		//$filter = ['_id' => new MongoDB\BSON\ObjectID($id)];
		//$filter = ['ip'=>'127.0.0.1'];
		$fieldname = '_id';
		$fieldvalue = $id;
		$filter  = $this->getFilter($fieldname,$fieldvalue);
		
		$options = $this->getOptions();
		return $this->queryFind($filter, $options);
	}
	public function findOnePostByNickName($nickname){
		$fieldname = 'nickname';
		$fieldvalue = $nickname;
		$filter  = $this->getFilter($fieldname,$fieldvalue);
		$options = $this->getOptions();
		return $this->queryFind($filter, $options);
	}
	
	public function findAllPosts(){
		$filter  = $this->getFilter(null,null);
		$options = $this->getOptions();
		return $this->queryFind($filter, $options);
		
	}
	
	public function queryFind($filter,$options){
		$query = new MongoDB\Driver\Query($filter, $options);
		$mongo = $this->getcon();
		$rows = $mongo->executeQuery('myhome.messageboard', $query);
		
		$arr = [];
		foreach ($rows as $document) {
			$id= (String)($document->_id);
			$ip = $document->ip;
			$textcontent = $document->textcontent;
			$nickname  = $document->nickname;
			$time  = $document->time;
			
			$onedoc['id'] =$id;
			$onedoc['ip'] =$ip;
			$onedoc['textcontent'] =$textcontent;
			$onedoc['nickname'] =$nickname;
			$onedoc['time'] =$time;
			
			array_push($arr, $onedoc );
			
		}
		
		return json_encode($arr);
	}
	
	
	function addone($data){
		$mongo = $this->getcon();
		$bulk = new MongoDB\Driver\BulkWrite;
		
		$document = $data;
		$document['_id'] = new MongoDB\BSON\ObjectID;
		
		$_id= $bulk->insert($document);
		
		$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
		$result = $mongo->executeBulkWrite('myhome.messageboard', $bulk, $writeConcern);
		
		$document['_id'] = (string)$document['_id'];
		return json_encode($document);
		
	}
	
	
	
}






