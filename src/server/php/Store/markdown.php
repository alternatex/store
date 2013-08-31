<?php namespace Store;

/**
* PHP Components *
*
* @module PHP
**/

// Load API
require(dirname(__FILE__).'/store.php');

/**
* Markdown Plaintext Store 
*
* @class Server
* @constructor
*/
class MarkdownStore extends Store {

  /**
  * Items collection
  * @property data
  * @private
  * @type {Array}
  * @default array()
  */
  private $items = array();

  /**
  * Datastore filename
  * @property data
  * @private
  * @type {Array}
  * @default array()
  */
  private $datastore = null;

  /**
  * Load repository 
  *
  * @method load
  * @param {String} $datastore context identifier
  * @void
  */ 
  public function load($datastore){}

  /**
  * Insert or update item data in datastore
  *
  * @method update
  * @param {Object} $item what it's about
  * @return {Boolean} Returns true on success
  */ 
  public function update($instance){

    // just write *
  	return file_put_contents($instance['path'], $instance['content'])
  }

  /**
  * Removes an item from datastore
  *
  * @method remove
  * @param {Object} $item what it's about
  * @return {Boolean} Returns true on success
  */ 
  public function remove($instance){
  	@unlink($instance['path'])
  }

  /**
  * Get item data
  *
  * @method get
  * @param {Object} $item what it's about
  * @return {Object} item instance
  */ 
  public function get($instance=null){    
		return @file_get_contents($instance['path']);
  }  
}