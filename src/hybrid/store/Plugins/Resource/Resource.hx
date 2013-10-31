package store.plugins.resource;

import store.Store;

/**
* Resource
*
* @class Resource
* @module Server
*/
class Resource { 
  
  /**
  * Data
  * @property data
  * @private
  * @type {Array}
  * @default ''
  */
  private var __data:Dynamic;

  public function new(data){    
    this.data(data);
  }

  public function data(data:Dynamic){
    if(data!=null) this.__data = data;
    return this.__data;
  }
}