<?php namespace Store\Protocol;

use Store\Store;

// TODO: thread-safety
// TODO: thread-safety
// TODO: thread-safety
// TODO: thread-safety
// TODO: thread-safety

/**
* FileSystem Plaintext Store 
*
* @class FileSystem
*/
abstract class FileSystem extends Store {

  /**
  * Path to file
  * @property filepath
  * @private
  * @type {Array}
  * @default array()
  */
  protected $filepath = null;

  /**
  * File content
  * @property content
  * @private
  * @type {String}
  * @default ''
  */
  protected $content = '';

  /**
  * Load repository 
  *
  * @method load
  * @param {String} $filepath context identifier
  * @void
  */ 
  public function load($filepath){
    $this->content = @file_get_contents($instance['path']);
  }

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

  /**
  * Persist data
  * 
  * @method persist
  * @param {String} filepath
  * @param {String} contents
  * @void
  */ 
  public function persist($path=null, $content=null){

    // update datastore * perf *
    return file_put_contents($path, $content);
  }  
}