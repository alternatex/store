/* neko server jcr fs -> folders: mkdir -p ... .content.json */

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

/**
* @enum Store's actions
*/
enum ACTION = {
  CREATE;
  READ;
  UPDATE;  
  DELETE;
};

/**
* @enum Store's request vars
*/
enum REQUEST = {
  CREATE;
  READ;
  UPDATE;  
  DELETE;
};

/**
* @enum Store's response vars
*/
enum RESPONSE = {
  CREATE;
  READ;
  UPDATE;  
  DELETE;
};

/**
* @enum Store's action/mapping configuration
*/
typedef MAPPING = {
  CREATE:Int,
  READ:Int,
  UPDATE:Int,
  DELETE:Int
};

/**
* @class Store
*/
class Store {

  /**
  * HTTP Header storage type indicator
  * @property REQUEST_HEADER_TYPE
  * @public
  * @type {String}
  * @default x-storage-type
  * @readOnly
  */
  inline static var REQUEST_HEADER_TYPE = 'X-Store-Type';

  /**
  * Toggle JSONP
  * @property RESPONSE_JSONP_ENABLED
  * @public
  * @type {Boolean}
  * @default true
  * @readOnly
  */
  inline static var RESPONSE_JSONP_ENABLED = true;

  /**
  * JSON callback identifier
  * @property RESPONSE_JSONP_CALLBACK
  * @public
  * @type {String}
  * @default "callback"
  * @readOnly
  */  
  inline static var RESPONSE_JSONP_CALLBACK = 'callback';

  /**
  * Entity attribute count
  * @property ENTITY_COUNT
  * @public
  * @type {String}
  * @default "count"
  * @readOnly
  */
  inline static var ENTITY_COUNT = 'count';

  /**
  * Entity attribute id
  * @property ENTITY_IDENTIFIER
  * @public
  * @type {String}
  * @default "id"
  * @readOnly
  */  
  inline static var ENTITY_IDENTIFIER = 'id';

  /**
  * l18n datastore.corrupt
  * @property MESSAGE_ERROR_DATASTORE_CORRUPT
  * @public
  * @type {String}
  * @default "DATASTORE IS CORRUPT"
  * @readOnly
  */
  inline static var MESSAGE_ERROR_DATASTORE_CORRUPT = 'DATASTORE IS CORRUPT';

  /**
  * l18n datastore.locked
  * @property MESSAGE_ERROR_DATASTORE_LOCKED
  * @public
  * @type {String}
  * @default "DATASTORE IS LOCKED"
  * @readOnly
  */
  inline static var  MESSAGE_ERROR_DATASTORE_LOCKED = 'DATASTORE IS LOCKED';

  /**
  * Request param action
  * @property REQUEST_ACTION
  * @public
  * @type {String}
  * @default "action"
  * @readOnly
  */
  inline static var  REQUEST_ACTION = 'action';

  /**
  * Request param namespace
  * @property REQUEST_NAMESPACE
  * @public
  * @type {String}
  * @default "namespace"
  * @readOnly
  */  
  inline static var  REQUEST_NAMESPACE = 'namespace';

  /**
  * Request param instance
  * @property REQUEST_DATA
  * @public
  * @type {String}
  * @default "instance"
  * @readOnly
  */  
  inline static var  REQUEST_DATA = 'instance';

  /**
  * Request param jsonp
  * @property REQUEST_JSONP
  * @public
  * @type {String}
  * @default "jsonp"
  * @readOnly
  */  
  inline static var  REQUEST_JSONP = 'jsonp';

  /**
  * Error *
  * @property RESPONSE_ERROR
  * @public
  * @type {String}
  * @default "error"
  * @readOnly
  */
  inline static var  RESPONSE_ERROR = 'error';

  /**
  * Action `get`
  * @property STORE_ACTION_GET
  * @public
  * @type {String}
  * @default "get"
  * @readOnly
  */
  inline static var  STORE_ACTION_GET = 'get';

  /**
  * Action `list`
  * @property STORE_ACTION_LIST
  * @public
  * @type {String}
  * @default "list"
  * @readOnly
  */  
  inline static var  STORE_ACTION_LIST = 'list';

  /**
  * Action `remove`
  * @property STORE_ACTION_REMOVE
  * @public
  * @type {String}
  * @default "remove"
  * @readOnly
  */  
  inline static var  STORE_ACTION_REMOVE = 'remove';

  /**
  * Action `update`
  * @property STORE_ACTION_UPDATE
  * @public
  * @type {String}
  * @default "update"
  * @readOnly
  */  
  inline static var  STORE_ACTION_UPDATE = 'update';

  /**
  * Request fileupload param source
  * @property TRANSFER_SOURCE
  * @public
  * @type {String}
  * @default "tmp_name"
  * @readOnly
  */
  inline static var  TRANSFER_SOURCE = 'tmp_name';

  /**
  * Request fileupload param name
  * @property TRANSFER_TARGET
  * @public
  * @type {String}
  * @default "name"
  * @readOnly
  */  
  inline static var  TRANSFER_TARGET = 'name'; 

  /**
  * Flag to indicated pending changes
  * @property pending
  * @protected
  * @type {Boolean}
  * @default false
  */
  private var pending:Bool = true;

  /**
  * Items collection
  * @property items
  * @static
  * @type {String}
  * @default ""
  */  
  private var items:Array<Item> = new Array();

  /**
  * Datastore filename
  * @property datastore
  * @protected
  * @type {String}
  * @default null
  */
  private var datastore:Dynamic;

  /**
  * Test something
  *
  * @method main  
  * @static
  * @param test {String}  
  */ 
  private static function test(test:String):Void {

    trace(test);
  }

  /**
  * Insert or update item data in datastore
  *
  * @method update
  * @param {Object} $resource what it's about
  * @return {Boolean} Returns true on success
  */ 
  override function update(resource:Resource):Void {

  }

  /**
  * Get resource data
  *
  * @method get
  * @param {Object} $resource what it's about
  * @return {Object} item instance
  */ 
  override function get(resource:Resource):Void {
    
  }

  /**
  * Removes a resource from datastore
  *
  * @method remove
  * @param {Object} $resource what it's about
  * @return {Boolean} Returns true on success
  */   
  override function remove(resource:Resource):Void {
    
  }

  /**
  * Load data
  * 
  * @method load
  * @param {String} dsn
  * @void
  */ 
  override function load($dsn):Void {
    
  }

  /**
  * Persist data
  * 
  * @method persist
  * @param {String} dsn
  * @void
  */ 
  override function persist($dsn);
  
  /**
  * Get/Set pending changes flag
  * 
  * @method isPending
  * @param {boolean} $pending
  * @return {boolean} 
  */ 
  public function pending(pending:Dynamic):Bool{
    if(pending!=null) this.pending = pending;
    return this.pending;
  }   

  /**
  * Mirror store actions *
  * 
  * @method mirror
  * @void
  */
  override function mirror():Void {
    // TODO: implement
  }   

  /**
  * Main routine
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
}        
