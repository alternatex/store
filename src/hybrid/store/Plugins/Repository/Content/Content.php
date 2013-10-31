<?php namespace Store\Repository;

/**
* PHPCR
*
* @class PhpCr
* @module Server
*/

use Store\Repository;

class PhpCr extends Repository {

  /**
  * Insert or update item data in datastore
  *
  * @method update
  * @param {Object} $item what it's about
  * @return {Boolean} Returns true on success
  */ 
  abstract function update(Resource $resource);

  /**
  * Get item data
  *
  * @method get
  * @param {Object} $item what it's about
  * @return {Object} item instance
  */ 
  abstract function get(Resource $resource=null);

  /**
  * Removes an item from datastore
  *
  * @method remove
  * @param {Object} $item what it's about
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
  public function pending($pending=null){
    if($pending!=null) $this->pending = $pending;
    return $this->pending;
  }   

  /**
  * Mirror store actions *
  * 
  * @method mirror
  * @void
  */
  public function mirror(){
    // TODO: implement
  }
}