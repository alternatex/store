package store;

/* neko server jcr fs -> folders: mkdir -p ... .content.json */
/* neko server jcr fs -> folders: mkdir -p ... .content.json */
/* neko server jcr fs -> folders: mkdir -p ... .content.json */

/**
* <common>                           
*/
import store.plugins.format.Format;
import store.plugins.format.json.Json;
import store.plugins.resource.collection.Collection;
import store.plugins.resource.Resource;
import store.plugins.resource.file.File;
import store.plugins.resource.element.Element;
import store.plugins.repository.Repository;
import store.plugins.repository.filesystem.FileSystem;
import store.plugins.schema.Schema;

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
* @class ItemTypeSafetyTest
*/
class ItemTypeSafetyTest {

}

enum Color {
  Red;
  Green;
  Blue;
}

class Item {

}

class Colors {
  static function toInt( c : Color ) : Int {
    return switch( c ) {
      case Red: 0xFF0000;
      case Green: 0x00FF00;
      case Blue: 0x0000FF;

    }
  }
}

/**
* @enum Store's actions
*/
enum Actions {
  create;
  read;
  update;  
  delete;
}

/**
* @enum Store's action/mapping configuration
*/
typedef Mapping = {
  create:Dynamic,
  read:Dynamic,
  update:Dynamic,
  delete:Dynamic
}
/**
* @class Base
*/
class Base {
  public var namexxx:String = "test";
  public function new(){
    //this.namexxx = "sali";
  }
}

/**
* @class Store
*/
class Store extends Base {

  /**
  * HTTP Header storage type indicator
  * @property REQUEST_HEADER_TYPE
  * @public
  * @type {String}
  * @default x-storage-type
  * @readOnly
  */
  inline public static var REQUEST_HEADER_TYPE = 'X-Store-Type';

  /**
  * Toggle JSONP
  * @property RESPONSE_JSONP_ENABLED
  * @public
  * @type {Boolean}
  * @default true
  * @readOnly
  */
  inline public static var RESPONSE_JSONP_ENABLED = true;

  /**
  * JSON callback identifier
  * @property RESPONSE_JSONP_CALLBACK
  * @public
  * @type {String}
  * @default "callback"
  * @readOnly
  */  
  inline public static var RESPONSE_JSONP_CALLBACK = 'callback';

  /**
  * Entity attribute count
  * @property ENTITY_COUNT
  * @public
  * @type {String}
  * @default "count"
  * @readOnly
  */
  inline public static var ENTITY_COUNT = 'count';

  /**
  * Entity attribute id
  * @property ENTITY_IDENTIFIER
  * @public
  * @type {String}
  * @default "id"
  * @readOnly
  */  
  inline public static var ENTITY_IDENTIFIER = 'id';

  /**
  * l18n datastore.corrupt
  * @property MESSAGE_ERROR_DATASTORE_CORRUPT
  * @public
  * @type {String}
  * @default "DATASTORE IS CORRUPT"
  * @readOnly
  */
  inline public static var MESSAGE_ERROR_DATASTORE_CORRUPT = 'DATASTORE IS CORRUPT';

  /**
  * l18n datastore.locked
  * @property MESSAGE_ERROR_DATASTORE_LOCKED
  * @public
  * @type {String}
  * @default "DATASTORE IS LOCKED"
  * @readOnly
  */
  inline public static var  MESSAGE_ERROR_DATASTORE_LOCKED = 'DATASTORE IS LOCKED';

  /**
  * Request param action
  * @property REQUEST_ACTION
  * @public
  * @type {String}
  * @default "action"
  * @readOnly
  */
  inline public static var  REQUEST_ACTION = 'action';

  /**
  * Request param namespace
  * @property REQUEST_NAMESPACE
  * @public
  * @type {String}
  * @default "namespace"
  * @readOnly
  */  
  inline public static var  REQUEST_NAMESPACE = 'namespace';

  /**
  * Request param instance
  * @property REQUEST_DATA
  * @public
  * @type {String}
  * @default "instance"
  * @readOnly
  */  
  inline public static var  REQUEST_DATA = 'instance';

  /**
  * Request param jsonp
  * @property REQUEST_JSONP
  * @public
  * @type {String}
  * @default "jsonp"
  * @readOnly
  */  
  inline public static var  REQUEST_JSONP = 'jsonp';

  /**
  * Error *
  * @property RESPONSE_ERROR
  * @public
  * @type {String}
  * @default "error"
  * @readOnly
  */
  inline public static var  RESPONSE_ERROR = 'error';

  /**
  * Action `get`
  * @property STORE_ACTION_GET
  * @public
  * @type {String}
  * @default "get"
  * @readOnly
  */
  inline public static var  STORE_ACTION_GET = 'get';

  /**
  * Action `list`
  * @property STORE_ACTION_LIST
  * @public
  * @type {String}
  * @default "list"
  * @readOnly
  */  
  inline public static var  STORE_ACTION_LIST = 'list';

  /**
  * Action `remove`
  * @property STORE_ACTION_REMOVE
  * @public
  * @type {String}
  * @default "remove"
  * @readOnly
  */  
  inline public static var  STORE_ACTION_REMOVE = 'remove';

  /**
  * Action `update`
  * @property STORE_ACTION_UPDATE
  * @public
  * @type {String}
  * @default "update"
  * @readOnly
  */  
  inline public static var  STORE_ACTION_UPDATE = 'update';

  /**
  * Request fileupload param source
  * @property TRANSFER_SOURCE
  * @public
  * @type {String}
  * @default "tmp_name"
  * @readOnly
  */
  inline public static var  TRANSFER_SOURCE = 'tmp_name';

  /**
  * Request fileupload param name
  * @property TRANSFER_TARGET
  * @public
  * @type {String}
  * @default "name"
  * @readOnly
  */  
  inline public static var  TRANSFER_TARGET = 'name'; 

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
  private var items:Array<Item>;

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
  * Insert or update resource data in datastore
  *
  * @method update
  * @param {Object} $resource what it's about
  * @return {Boolean} Returns true on success
  */ 
  public function update(resource:Resource):Void {
  
    #if client
      // remoting delegate/send and forget?
    #end

  }

  /**
  * Get resource data
  *
  * @method get
  * @param {Object} $resource what it's about
  * @return {Object} resource instance
  */ 
  public function get(resource:Resource):Void {
  
  }

  /**
  * Removes a resource from datastore
  *
  * @method remove
  * @param {Object} $resource what it's about
  * @return {Boolean} Returns true on success
  */   
  public function remove(resource:Resource):Void {
  
  }

  /**
  * Load data
  * 
  * @method load
  * @param {String} dsn
  * @void
  */ 
  public function load(dsn:String):Void {
  
  }

  /**
  * Persist data
  * 
  * @method persist
  * @param {String} dsn
  * @void
  */ 
  public function persist(dsn:String):Bool {
    return true;
  }
  
  /**
  * Get/Set pending changes flag
  * 
  * @method isPending
  * @param {boolean} $pending
  * @return {boolean} 
  */ 
  public function isPending(pending:Dynamic):Bool {
    if(pending!=null) this.pending = pending;
    return this.pending;
  }   

  /**
  * Mirror store actions *
  * 
  * @method mirror
  * @void
  */
  public function mirror():Void {
    // TODO: implement
    //trace("mirror");
  }   

  /**
  * Main routine
  *
  * @method main
  * @static
  */ 
  function new() {
    super();
  }

  /*static function test() {
    trace("testtesttest");
  }*/

  static function main() {
    var resource:Resource = new Resource("123");
    var namespace:String = "person";
    var action:String = "update";
    var jsonp:String = "";
    var user:String = "anonymous";
    var file:File = new File("afile.txt");
    var p = Json.Encode({ x : -1, y : 65, name: "James" });
    var test = Json.Decode(p);
    trace(test.name);
    test.name = "Jefferey";
    var test2 = Json.Encode(test);
    var test3 = Json.Decode(test2);
    //var json:Dynamic = haxe.Json.parse('{"name": "james"}');

    
    trace(test2);
    trace(test3.name);    
/*

// initialize storage
$Store = '\\Store\\Repository\\Memory';

// hold store opening party
$store = new $Store();

// extract request params
$instance = getvar('instance');

// naming - TODO: solve
if($basedir!="") $namespace = $basedir;

// check prerequisites
if(trim($namespace)=="" || trim($action)=="") {

  // return error 
  $err = json_encode(array(Store::RESPONSE_ERROR => "namespace: $namespace or action: $action not set"));
  die(strlen($jsonp)>0 ? $jsonp."("."console.error(".$err."));":$err);
}

// ----------------------------------------------------------------------------
// - INITIALIZE II
// ----------------------------------------------------------------------------

function recursive_mkdir($path, $mode = 0777) {
    $dirs = explode(DIRECTORY_SEPARATOR , $path);
    $count = count($dirs);
    $path = '.';
    for ($i = 0; $i < $count; ++$i) {
        $path .= DIRECTORY_SEPARATOR . $dirs[$i];
        if (!is_dir($path) && !mkdir($path, $mode)) {
            return false;
        }
    }
    return true;
}

$rootdir = '';
if(strpos($namespace, '|')!==false){
  $segments = explode('|', $namespace);
  $segments_tmp = array();
  foreach ($segments as $segment) {
    if(trim($segment)!='') array_push($segments_tmp, $segment);
  }
  $segments = $segments_tmp;
  unset($segments_tmp);
  $segmentPath = implode('/', array_slice($segments, 0, -1));
  $rootdir.=$segmentPath;
  //mkdir($rootdir, 0700, true);
  @recursive_mkdir($rootdir.'/');
  //die($rootdir); 
  $namespace = $segments[sizeof($segments)-1];
} else {
  $rootdir='./';
}

// TODO: 
// - full rewrite to disk using...
// - post only to write, which makes sense
// - get rid of all other parameters

// load contents
$datastore = $rootdir.'/'.$user.".".$namespace.'.json';
$store->load($datastore);

// return value helper 
$returnValue = null;

// wrap data (refactor step1; refactor step2 will be scaffolding..)
$item = new Item($instance);

// ----------------------------------------------------------------------------
// - PROCESS
// ----------------------------------------------------------------------------

// handle action *
switch($action){
  case Store::STORE_ACTION_UPDATE:
    $returnValue = $store->update($item);
    break;
  case Store::STORE_ACTION_REMOVE:
    $returnValue = $store->remove($item);
    break;
  case Store::STORE_ACTION_GET:
    $returnValue = $store->get($item);
    break;
  case Store::STORE_ACTION_LIST:     
    $returnValue = $store->get();
    break;
  default:
    $err = json_encode(array(Store::RESPONSE_ERROR => "unknown action: $action"));
    die(strlen($jsonp)>0 ? $jsonp."("."console.error(".$err."));":$err);  
    break;
}

// empty buffer
ob_get_clean();

// write changes to disk *
if($store->pending()){
  $store->persist($datastore);
}

// ----------------------------------------------------------------------------
// - RESPOND
// ----------------------------------------------------------------------------

// be nice
header('Content-Type: text/javascript');

// send response
if(strlen($jsonp)>0) {
  print $jsonp."(".json_encode($returnValue).");";
} else {
  print json_encode($returnValue);
} 
*/

    /*
    this.items[0] = new ItemTypeSafetyTest();

    trace(this.name);
    this.test("123");
    trace("Hello World !"+this.name);
    this.name="moin";
    trace("Hello World !"+this.name);
    var a : Test3 = new Test3();
    a.me="john";
    var b : Test1 = cast(a,Test1);
    trace(b.me);
    */
    // JavaScript::$(document).ready(...)
    #if js
  /*    new JQuery(function():Void { 
      new JQuery("body").css('background-color', 'black');
    });*/
    #end
    
    var mapping:Mapping = {
      create: Actions.create,
      read: Actions.read,
      update: Actions.update,
      delete: Actions.delete,
    };
    var item:Element = new Element("asdasd");    
    var file:File = new File("app.yml");

    //trace(mapping);
    //trace("hey there! wazzup???");
  }
}        
