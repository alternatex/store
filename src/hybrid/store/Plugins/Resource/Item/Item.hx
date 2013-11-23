package store.plugins.resource.item;

import store.plugins.resource.Resource;

/**
* Item
*
* @class Item
* @module Server
*/
class Item extends Resource{ 
  public function new(data){
    super(data);
		trace("hey there! wazzup???"+data);
  } 
   
  static function test() {
    trace("testtesttest");
  }
}