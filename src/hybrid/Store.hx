/**
* <php>                           
*/
#if php
import php.Lib;
#end

/**
* <js>                           
*/
#if js
// magic
#end

/**
* @class Item
*/
class Item {

}

/**
* @class ItemTypeSafetyTest
*/
class ItemTypeSafetyTest {

}

/*
override private function dada():Void {

}
*/

/**
* @class Store
*/
class Store {

  /**
  * Flag to indicated pending changes
  * @property pending
  * @protected
  * @type {Boolean}
  * @default false
  */
  private pending : Boolean = true;

  /**
  * Items collection
  * @property items
  * @static
  * @type {String}
  * @default ""
  */  
  var items : Array<Item> = new Array();

  /**
  * Items collection
  * @property data
  * @protected
  * @type {Array}
  * @default array()
  */
  protected $items = array();

  /**
  * Datastore filename
  * @property datastore
  * @protected
  * @type {String}
  * @default null
  */
  protected $datastore = null;

  /**
  * HTTP Header storage type indicator
  * @property REQUEST_HEADER_TYPE
  * @public
  * @type {String}
  * @default x-storage-type
  * @readOnly
  */
  const REQUEST_HEADER_TYPE = 'X-Store-Type';

  /**
  * Toggle JSONP
  * @property RESPONSE_JSONP_ENABLED
  * @public
  * @type {Boolean}
  * @default true
  * @readOnly
  */
  const RESPONSE_JSONP_ENABLED = true;

  /**
  * JSON callback identifier
  * @property RESPONSE_JSONP_CALLBACK
  * @public
  * @type {String}
  * @default "callback"
  * @readOnly
  */  
  const RESPONSE_JSONP_CALLBACK = 'callback';

  /**
  * Entity attribute count
  * @property ENTITY_COUNT
  * @public
  * @type {String}
  * @default "count"
  * @readOnly
  */
  const ENTITY_COUNT = 'count';

  /**
  * Entity attribute id
  * @property ENTITY_IDENTIFIER
  * @public
  * @type {String}
  * @default "id"
  * @readOnly
  */  
  const ENTITY_IDENTIFIER = 'id';

  /**
  * l18n datastore.corrupt
  * @property MESSAGE_ERROR_DATASTORE_CORRUPT
  * @public
  * @type {String}
  * @default "DATASTORE IS CORRUPT"
  * @readOnly
  */
  const MESSAGE_ERROR_DATASTORE_CORRUPT = 'DATASTORE IS CORRUPT';

  /**
  * l18n datastore.locked
  * @property MESSAGE_ERROR_DATASTORE_LOCKED
  * @public
  * @type {String}
  * @default "DATASTORE IS LOCKED"
  * @readOnly
  */
  const MESSAGE_ERROR_DATASTORE_LOCKED = 'DATASTORE IS LOCKED';

  /**
  * Request param action
  * @property REQUEST_ACTION
  * @public
  * @type {String}
  * @default "action"
  * @readOnly
  */
  const REQUEST_ACTION = 'action';

  /**
  * Request param namespace
  * @property REQUEST_NAMESPACE
  * @public
  * @type {String}
  * @default "namespace"
  * @readOnly
  */  
  const REQUEST_NAMESPACE = 'namespace';

  /**
  * Request param instance
  * @property REQUEST_DATA
  * @public
  * @type {String}
  * @default "instance"
  * @readOnly
  */  
  const REQUEST_DATA = 'instance';

  /**
  * Request param jsonp
  * @property REQUEST_JSONP
  * @public
  * @type {String}
  * @default "jsonp"
  * @readOnly
  */  
  const REQUEST_JSONP = 'jsonp';

  /**
  * Error *
  * @property RESPONSE_ERROR
  * @public
  * @type {String}
  * @default "error"
  * @readOnly
  */
  const RESPONSE_ERROR = 'error';

  /**
  * Action `get`
  * @property STORE_ACTION_GET
  * @public
  * @type {String}
  * @default "get"
  * @readOnly
  */
  const STORE_ACTION_GET = 'get';

  /**
  * Action `list`
  * @property STORE_ACTION_LIST
  * @public
  * @type {String}
  * @default "list"
  * @readOnly
  */  
  const STORE_ACTION_LIST = 'list';

  /**
  * Action `remove`
  * @property STORE_ACTION_REMOVE
  * @public
  * @type {String}
  * @default "remove"
  * @readOnly
  */  
  const STORE_ACTION_REMOVE = 'remove';

  /**
  * Action `update`
  * @property STORE_ACTION_UPDATE
  * @public
  * @type {String}
  * @default "update"
  * @readOnly
  */  
  const STORE_ACTION_UPDATE = 'update';

  /**
  * Request fileupload param source
  * @property TRANSFER_SOURCE
  * @public
  * @type {String}
  * @default "tmp_name"
  * @readOnly
  */
  const TRANSFER_SOURCE = 'tmp_name';

  /**
  * Request fileupload param name
  * @property TRANSFER_TARGET
  * @public
  * @type {String}
  * @default "name"
  * @readOnly
  */  
  const TRANSFER_TARGET = 'name'; 

  /**
  * Main module
  *
  * @method main
  * @static
  */ 
  static function main() {

    Store.items[0] = new ItemTypeSafetyTest();

    trace(Index.name);
    Index.test("123");
    trace("Hello World !"+Index.name);
    Index.name="moin";
    trace("Hello World !"+Index.name);
    var a : Test3 = new Test3();
    a.me="john";
    var b : Test1 = cast(a,Test1);
    trace(b.me);

    // JavaScript::$(document).ready(...)
    #if js
    new JQuery(function():Void { 
      new JQuery("body").css('background-color', 'black');
    });
    #end
  }

  /**
  * Test something
  *
  * @method main  
  * @static
  * @param test {String}  
  */ 
  static function test(test: String): Void{
    trace(test);
  }

  /**
  * Static class initialization routine
  * @function __init__
  * @private
  * @return {Void}
  */
  static function __init__() {
         
  }  
}        