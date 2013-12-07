package store.plugins.repository;

import store.Store;
import store.plugins.resource.Resource;

/**
* Repository
*
* @class Repository
* @module Server
*/
class Repository extends Store {

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
    if(pending!=null) this.pending = pending;
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
