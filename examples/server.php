<?php

// ----------------------------------------------------------------------------
// - TODOS
// ----------------------------------------------------------------------------

// -> Amanda validation *
// -> ACL Example -> Header > alternatex/authenticate *

// ----------------------------------------------------------------------------
// - SETUP
// ----------------------------------------------------------------------------

// aliases
use \Store\Store, 
    \Store\Resource\File, 
    \Store\Resource\Item, 
    \Store\Format,
    \Store\Resource;

// class loader
require_once('vendor/autoload.php');

// include routing core
require_once __DIR__.'/vendor/sofadesign/limonade/lib/limonade.php';

// initialize 
session_start();

// buffer output
ob_start();

// TODO: export - configuration: request
define('HEADER_STORE_TYPE',     'X-Store-Type');
define('HEADER_STORE_CALLBACK', 'X-Store-Callback');

$format = new Format\Object();
$file = new File();

$file->format($format);
$file->content("lalalala");

// retrieve request headers
$requestHeaders = getallheaders();

// extract storage type
if(isset($requestHeaders[HEADER_STORE_TYPE])) die($requestHeaders[HEADER_STORE_TYPE]);

// determine store based on special header field
// x-store-type: object/json,markdown,... 4 client driven -> limonade
// json configuration by path, ..... 4 server driven -> limonade

// TODO:
// common function validating request against schema
// v1: generalized
// v2: subjectified (namespaced)
// v3: ... 

// ...
$namespace='';
$action='';
$jsonp='';

// configuration callback
function configure(){
  option('env', ENV_DEVELOPMENT);
}

// ----------------------------------------------------------------------------
// - DISPATCH CUSTOM
// ----------------------------------------------------------------------------

// TODO: load customizations here *
// TODO: load customizations here *
// TODO: load customizations here *

// ----------------------------------------------------------------------------
// - DISPATCH CORE
// ----------------------------------------------------------------------------

// ...
dispatch('/:namespace/:action/:jsonp/', 'v1');
dispatch_post('/:namespace/:action/:jsonp/', 'v1');

// ...
function v1() {
  global $namespace, $action, $jsonp;  
  // ...
  $namespace = params('namespace');
  $action = params('action');
  $jsonp = params('jsonp');

  // ...
  return $namespace.$action.$jsonp;
}

// process request
run();

// ----------------------------------------------------------------------------
// - SANITIZE
// ----------------------------------------------------------------------------

// defaults
$user='anonymous';

// initialize storage
$Store = '\\Store\\Repository\\Memory';

// hold store opening party
$store = new $Store();

// extract request params
$instance = isset($_POST['instance']) ? $_POST['instance'] : $_GET['instance'];

// check prerequisites
if(trim($namespace)=="" || trim($action)=="") {

  // return error 
  $err = json_encode(array(Store::RESPONSE_ERROR => "namespace: $namespace or action: $action not set"));
  die(strlen($jsonp)>0 ? $jsonp."("."console.error(".$err."));":$err);
}

// ----------------------------------------------------------------------------
// - INITIALIZE II
// ----------------------------------------------------------------------------

// determine datastore filename
$datastore = $user.".".$namespace.'.dat';
$datastore = $user.".".$namespace.'.json';

$file = new File();
$file->path($datastore);

// load contents
$store->load($file->path());

// helper - store to disk *
$dostore = false;

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