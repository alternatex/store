<?php

// TODO: export - configuration: request
define('HEADER_STORE_TYPE',     'X-Store-Type');
define('HEADER_STORE_CALLBACK', 'X-Store-Callback');

// class loader
require_once('vendor/autoload.php');

// initialize 
session_start();

// buffer output
ob_start();

// aliases
use \Store\Store, 
    \Store\Resource\File, 
    \Store\Resource\Item, 
    \Store\Format,
    \Store\Resource;

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

// -> limonade
// -> limonade
// -> limonade
// -> limonade
// -> limonade

// -> amanda validation *
// -> amanda validation *
// -> amanda validation *
// -> amanda validation *
// -> amanda validation *

// -> acl sample ?
// -> acl sample ?
// -> acl sample ?
// -> acl sample ?
// -> acl sample ?

// defaults
$user='anonymous';

// determine datastore filename
$datastore = $user.".".$namespace.'.json';

// initialize storage
$Store = '\\Store\\Repository\\Memory';

// hold store opening party
$store = new $Store();

// extract request params
foreach(array(Store::REQUEST_NAMESPACE, Store::REQUEST_ACTION, Store::REQUEST_DATA, Store::REQUEST_JSONP) as $param) {
  ${$param} = isset($_GET[$param]) ? $_GET[$param] : $_POST[$param];
}

// check prerequisites
if(trim($namespace)=="" || trim($action)=="") {

  // return error 
  $err = json_encode(array(Store::RESPONSE_ERROR => "namespace: $namespace or action: $action not set"));
  die(strlen($jsonp)>0 ? $jsonp."("."console.error(".$err."));":$err);
}

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

// handle action *
switch($action){
  case Store::STORE_ACTION_UPDATE:
    $returnValue = $store->update($item);
    $store->pending(true);
    break;
  case Store::STORE_ACTION_REMOVE:
    $returnValue = $store->remove($item);
    $store->pending(true);
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

// be nice
header('Content-Type: text/javascript');

// send response
if(strlen($jsonp)>0) {
  print $jsonp."(".json_encode($returnValue).");";
} else {
  print json_encode($returnValue);
} 