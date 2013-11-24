package store.plugins.resource.collection;

import store.plugins.resource.Resource;

/**
* Collection
*
* @class Collection
* @module Server
*/
class Collection extends Resource{ 
  public function new(data){
    super(data);
		trace("hey there! wazzup???"+data);
  } 
   
  static function test() {
    trace("testtesttest");
  }
}