<?php namespace Store\Driver;

use Store\Driver\FileSystem;

/**
* PHP Components *
*
* @module PHP
**/

/**
* Markdown Plaintext Store 
*
* @class Markdown
* @constructor
*/
class Markdown extends FileSystem {

  /**
  * Path to file
  * @property filepath
  * @private
  * @type {Array}
  * @default array()
  */
  private $filepath = null;

  /**
  * Load repository 
  *
  * @method load
  * @param {String} $filepath context identifier
  * @void
  */ 
  public function load($filepath){}

  /**
  * Insert or update item data in filepath
  *
  * @method update
  * @param {Object} $item what it's about
  * @return {Boolean} Returns true on success
  */ 
  public function update($instance){
    return file_put_contents($instance['path'], $instance['content']);
  }

  /**
  * Removes an item from filepath
  *
  * @method remove
  * @param {Object} $item what it's about
  * @return {Boolean} Returns true on success
  */ 
  public function remove($instance){
    @unlink($instance['path']);
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

  public function response(){

  }
}