package store.plugins.resource.element;

import store.plugins.resource.Resource;

/**
* Element
*
* @class Element
* @module Server
*/
class Element extends Resource{ 
  public function new(data){
    super(data);
		//trace("hey there! wazzup???"+data);
  } 
   
  static function test() {
    trace("testtesttest");
  }
}