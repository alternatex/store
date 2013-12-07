package store.plugins.repository.filesystem;

import store.Store;
import store.plugins.repository.Repository;
import store.plugins.resource.Resource;

#if php
import php.Lib;
#end

#if (php || java)
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
    #if (php || java)
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
    #if (php || java)
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
    #if (php || java)
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
    #if (php || java)
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
    #if (php || java)
    SysFile.saveContent('/Library/WebServer/Documents/store/src/hybrid/datastore/output.txt', "bladibla");
    #end   
    return false; 
  }
     
}
