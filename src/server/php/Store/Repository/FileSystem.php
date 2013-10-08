<?php namespace Store\Repository;

// TODO: thread-safety

use Store\Repository;
use Store\Resource;
use Store\Resource\File;

/**
* FileSystem Plaintext Store 
*
* @class FileSystem
*/
abstract class FileSystem extends Repository {

  /**
  * Load repository 
  *
  * @method load
  * @param {String} $filepath context identifier
  * @void
  */ 
  public function load($filepath){
    $this->content = @file_get_contents($filepath);
  }

  /**
  * Insert or update item data in filepath
  *
  * @method update
  * @param {Object} $item what it's about
  * @return {Boolean} Returns true on success
  */ 
  public function update(Resource $file){
    return file_put_contents($file->path(), $file->content());
  }

  /**
  * Removes an item from filepath
  *
  * @method remove
  * @param {Object} $item what it's about
  * @return {Boolean} Returns true on success
  */ 
  public function remove(Resource $file){
    @unlink($file->path());
  }

  /**
  * Get item data
  *
  * @method get
  * @param {Object} $item what it's about
  * @return {Object} item instance
  */ 
  public function get(Resource $file=null){    
    return @file_get_contents($file->path());
  }  

  /**
  * Persist data
  * 
  * @method persist
  * @param {String} filepath
  * @param {String} contents
  * @void
  */ 
  public function persist($filepath, $content=''){

    // update datastore * perf *
    return self::persistToDisk($filepath, $content);
  }  

  /**
  * Persist data static
  * 
  * @method persistToDisk
  * @param {String} filepath
  * @param {String} contents
  * @void
  */ 
  public static function persistToDisk($filepath, $content=''){

    // update datastore * perf *
    return file_put_contents($filepath, $content);
  }  
}