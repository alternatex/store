package store;

import store.plugins.format.Format;
import store.plugins.format.json.Json;

import store.plugins.resource.Resource;
import store.plugins.resource.collection.Collection;
import store.plugins.resource.element.Element;
import store.plugins.resource.file.File;

import store.plugins.repository.Repository;
import store.plugins.repository.filesystem.FileSystem;
//import store.plugins.repository.arangodb.ArangoDB;

import store.plugins.schema.Schema;

#if php
import php.Lib;
#end

#if (php || java)
import sys.FileSystem in SysFileSystem;
import sys.io.File in SysFile;
#end

#if js
// magic
#end

class MyAPI{
  public function new(){

  }
  public function create():Dynamic{
    return null;
  }
  public function read():Dynamic{
    return false;
  }
  public function update():Dynamic{
    return false;
  }
  public function delete():Dynamic{
    return false;
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
* @class Item
*/
class Item {
  public function new(){}
}

/**
* @class Base
*/
class Base {
  public function new(){}
}

@:expose
typedef API = {
  function create():Dynamic;
  function read():Dynamic;
  function update():Dynamic;
  function delete():Dynamic;
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
  @:expose
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
  public function route(route:String):Void {
  
    #if client
      // remoting delegate/send and forget?
    #end

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
  
  @:expose
  public static function SampleAPI():API{
    return new MyAPI();  
  }

  static function main() {

    var resource:Resource = new Resource("123");

    // get request vars - start
    #if php
      // php direct eval magic * duh.
    #end    
    #if java
      // java command line vs «servlet» deployment? fuuu.
    #end
    // get request vars - end

    var global = {      
      action:    "update",
      namespace: "Person",      
      data:      "",
      user:      "anonymous"
    };

    #if php
      var value:String = "test";
      untyped __php__("eval('$_GET[\\'instance\\']=123;'); echo '<pre>'; print_r($value); echo '</pre>'; ");
      try{
        //untyped __php__('$_GET["instance"]=123');
        var value : String = untyped __var__('_GET', 'instance2');  
        trace("value is: "+value);
      } catch(ex:Dynamic){
        trace("exception <small>" + ex + "</small>");
      }
    #end

    var file:File = new File("afile.txt");

    // initialize storage
    var store:Store = new Store(); // TODO: new Memory();

    /*
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

    // JavaScript::$(document).ready(...)
    #if js
    /*    
    new JQuery(function():Void { 
      new JQuery("body").css('background-color', 'black');
    });
    */
    #end
    
    var item:Element = new Element("asdasd");    
    var file:File = new File("app.yml");
    
    #if (php || java)
      SysFile.saveContent('/Library/WebServer/Documents/store/src/hybrid/datastore/output.txt', "bladibla");
      trace(SysFile.getContent('/Library/WebServer/Documents/store/src/hybrid/datastore/output.txt'));
      #if php
      var value:String = "test";
      try{
        //untyped __php__('$_GET["instance"]=123');
        value = untyped __var__('_GET', 'instance2');  
      } catch(ex:Dynamic){
        trace("exception <small>" + ex + "</small>");
      }

      SysFile.saveContent('./output.txt', "bladibla PHP!"+value);
      #end
      #if java
      SysFile.saveContent('./output.txt', "bladibla JAVA!");
      #end      
    #end 

    /*
    enum Color {
      Red;
      Green;
      Blue;
    }

    class Colors {
      public static function toInt( c : Color ) : Int {
        return switch( c ) {
          case Red: 0xFF0000;
          case Green: 0x00FF00;
          case Blue: 0x0000FF;
        }
      }
    }   
    trace(Colors.toInt(Color.Blue));
    trace(Colors.toInt(Color.Red));
    trace(Colors.toInt(Color.Green));
    */

  }
}        
