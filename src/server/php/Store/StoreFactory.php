<?php namespace Store;

/**
* PHP Components *
*
* @module PHP
**/

/**
* ...
*
* @class StoreFactory
* @constructor
*/
class StoreFactory { 

  /**
  * Shared store instances 
  * @property $stores
  * @private
  * @static
  * @type {Array}
  * @default array()
  */ 
	private $stores = array();

  /**
  * Loaded stores
  * @property $stores
  * @private
  * @static
  * @type {Array}
  * @default array()
  */ 
	private $loaded = array();


  /**
  * Constructor
  *
  * @method __construct
  */  
  private function __construct(){
    
  }

  /**
  * Retrieve instance 
  *
  * @method getInstance
  * @param {String} $database  
  */  
	public static function getInstance(){
		static $instance = null;
		if($instance==null) $instance = new StoreFactory();
		return $instance;
	}

  /**
  * Load storage adapter
  *
  * @method loadStore
  * @param {String} $name  
  * @param {Boolean} $shared  
  */  
	public function loadStore($name){
		if(!class_exists(ucfirst($name).'Store', false)){
			$storeClassPath = $this->getStoreClassPath($name);
			if(file_exists($storeClassPath)) {			
				require_once($storeClassPath);					
			} else {
				throw new Exception('Store `'.$name.'` not found in: '.$storeClassPath);
			}			
		}
	}

  /**
  * Returns fully qualified store classpath
  *
  * @method getStoreClassPath
  * @param {String} $name  
  * @return {String} fully qualified path  
  */ 
	public function getStoreClassPath($name){
		return __DIR__.DIRECTORY_SEPARATOR.strtolower($name).'.php';
	}

  /**
  * Retrieve storage adapter by name
  *
  * @method getInstance
  * @param {String} $name  
  * @param {Boolean} $shared 
  * @return {Store} storage adapter instance
  */  
	public function getStoreByName($name, $shared=true){

	}
}