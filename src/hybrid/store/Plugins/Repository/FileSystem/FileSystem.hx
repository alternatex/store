package store.plugins.repository.filesystem;

import store.Store;
import store.plugins.repository.Repository;
import store.plugins.resource.Resource;

/**
* Repository
*
* @class Repository
* @module Server
*/
class FileSystem extends Repository {

  /**
  * Insert or update item data in datastore
  *
  * @method update
  * @param {Object} $item what it's about
  * @return {Boolean} Returns true on success
  */ 
  public override function update(resource:Resource){}

  /**
  * Get item data
  *
  * @method get
  * @param {Object} $item what it's about
  * @return {Object} item instance
  */ 
  public override function get(resource:Resource){}

  /**
  * Removes an item from datastore
  *
  * @method remove
  * @param {Object} $item what it's about
  * @return {Boolean} Returns true on success
  */   
  public override function remove(resource:Resource){}

  /**
  * Load data
  * 
  * @method load
  * @param {String} dsn
  * @void
  */ 
  public override function load(dsn:String){}


  /**
  * Persist data
  * 
  * @method persist
  * @param {String} dsn
  * @void
  */ 
  public override function persist(dsn:String):Bool{
    return false;
  }
  
  /**
  * Get/Set pending changes flag
  * 
  * @method isPending
  * @param {boolean} $pending
  * @return {boolean} 
  */ 
  public override function isPending(pending:Dynamic):Bool{
    if(pending!=null) this.pending = (pending!=null) ? (pending==true?true:false) : (pending==false?false:true);
    return this.pending;
  }   

  /**
  * Mirror store actions *
  * 
  * @method mirror
  * @void
  */
  public override function mirror(){
    // TODO: implement
  }
}


//<?php namespace Store\Repository;

// TODO: thread-safety

//use Store\Repository;
//use Store\Resource;
//use Store\Resource\File;

/**
* FileSystem Plaintext Store 
*
* @class FileSystem
* @module Server
*/
//abstract class FileSystem extends Repository {

  /**
  * Load repository 
  *
  * @method load
  * @param {String} $filepath context identifier
  * @void
  */ 
//  public function load($filepath){
 //   $this->content = @file_get_contents($filepath);
  //}

  /**
  * Insert or update item data in filepath
  *
  * @method update
  * @param {Object} $item what it's about
  * @return {Boolean} Returns true on success
  */ 
  //public function update(Resource $file){
   // return file_put_contents($file->path(), $file->content());
  //}

  /**
  * Removes an item from filepath
  *
  * @method remove
  * @param {Object} $item what it's about
  * @return {Boolean} Returns true on success
  */ 
  //public function remove(Resource $file){
   // @unlink($file->path());
  //}

  /**
  * Get item data
  *
  * @method get
  * @param {Object} $item what it's about
  * @return {Object} item instance
  */ 
 // public function get(Resource $file=null){    
  //  return @file_get_contents($file->path());
  //}  

  /**
  * Persist data
  * 
  * @method persist
  * @param {String} filepath
  * @param {String} contents
  * @void
  */ 
 // public function persist($filepath, $content=''){

    // update datastore * perf *
   // return self::persistToDisk($filepath, $content);
  //}  

  /**
  * Persist data static
  * 
  * @method persistToDisk
  * @param {String} filepath
  * @param {String} contents
  * @void
  */ 
//  public static function persistToDisk($filepath, $content=''){

    // update datastore * perf *
  //  return file_put_contents($filepath, $content);
  //}  
//}