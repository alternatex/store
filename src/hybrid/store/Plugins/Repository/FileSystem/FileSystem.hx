package store.plugins.repository.filesystem;

import store.Store;
import store.plugins.repository.Repository;
import store.plugins.resource.Resource;

/**
* <php>                           
*/
#if php
import php.Lib;
import sys.FileSystem in SysFileSystem;
import sys.io.File in SysFile;
#end

/**
* FileSystem Repository Driver
*
* @class FileSystem
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
  public override function update(resource:Resource){
    /**
    * <php>                           
    */
    #if php
    SysFile.saveContent("", "" /*resource.path(), resource.content()*/);
    #end  
  }

  /**
  * Get item data
  *
  * @method get
  * @param {Object} $item what it's about
  * @return {Object} item instance
  */ 
  public override function get(resource:Resource){
    /**
    * <php>                           
    */
    #if php
    SysFile.getContent("");
    #end        
  }

  /**
  * Removes an item from datastore
  *
  * @method remove
  * @param {Object} $item what it's about
  * @return {Boolean} Returns true on success
  */   
  public override function remove(resource:Resource){
    /**
    * <php>                           
    */
    #if php
    SysFileSystem.deleteFile("");
    #end
  }

  /**
  * Load data
  * 
  * @method load
  * @param {String} filepath
  * @void
  */ 
  public override function load(filepath:String){
    /**
    * <php>                           
    */
    #if php
    SysFile.getContent(filepath);
    #end    
  }

  /**
  * Persist data
  * 
  * @method persist
  * @param {String} filepath
  * @void
  */ 
  public override function persist(filepath:String):Bool{
    /**
    * <php>                           
    */    
    #if php
    SysFile.saveContent('/Library/WebServer/Documents/store/src/hybrid/datastore/output.txt', "bladibla");
    #end   
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
    if(pending!=null) this.pending = pending;
    return this.pending;
  }   
}
