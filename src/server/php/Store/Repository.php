<?php namespace Store;

use Store\Store;

/**
* Repository
*
* @class Repository
* @module Server
*/
abstract class Repository extends Store { 

  /**
  * Insert or update item data in datastore
  *
  * @method update
  * @param {Object} $resource what it's about
  * @return {Boolean} Returns true on success
  */ 
  abstract function update(Resource $resource);

  /**
  * Get resource data
  *
  * @method get
  * @param {Object} $resource what it's about
  * @return {Object} item instance
  */ 
  abstract function get(Resource $resource=null);

  /**
  * Removes a resource from datastore
  *
  * @method remove
  * @param {Object} $resource what it's about
  * @return {Boolean} Returns true on success
  */   
  abstract function remove(Resource $resource);

  /**
  * Load data
  * 
  * @method load
  * @param {String} dsn
  * @void
  */ 
  abstract function load($dsn);  

  /**
  * Persist data
  * 
  * @method persist
  * @param {String} dsn
  * @void
  */ 
  abstract function persist($dsn);
  
  /**
  * Get/Set pending changes flag
  * 
  * @method isPending
  * @param {boolean} $pending
  * @return {boolean} 
  */ 
  private function pending($pending=null){
    if($pending!=null) $this->pending = $pending;
    return $this->pending;
  }   

  /**
  * Mirror store actions *
  * 
  * @method mirror
  * @void
  */
  protected function mirror(){
    // TODO: implement
  }  
}