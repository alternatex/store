<?php
// ----------------------------------------------------------------------------
// - TODOS
// ----------------------------------------------------------------------------

// -> Amanda validation *
// -> ACL Example -> Header > alternatex/authenticate *
// -> Accept-Encoding -> Format * (eg. Markdown decoding, ...)

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

// http headers for store -> move over to base *
define('HEADER_STORE_TYPE',     'X-Store-Type');
define('HEADER_STORE_CALLBACK', 'X-Store-Callback');

// helper
function getvar($variable){
  return isset($_POST[$variable]) ? $_POST[$variable] : (isset($_GET[$variable]) ? $_GET[$variable] : null);
}

// retrieve request headers
$requestHeaders = getallheaders();

// extract storage type
if(isset($requestHeaders[Store::REQUEST_HEADER_TYPE])) die($requestHeaders[Store::REQUEST_HEADER_TYPE]);

// ...
$namespace='';
$action='';
$jsonp='';

// configuration callback
function configure(){
  option('env', ENV_DEVELOPMENT);
}

function extractParams(){
  global $namespace, $action, $jsonp;  

  // ...
  $namespace = params('namespace');
  $action = params('action');
  $jsonp = params('jsonp');

}

// ----------------------------------------------------------------------------
// - DISPATCH CUSTOM
// ----------------------------------------------------------------------------

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
  extractParams();

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
$instance = getvar('instance');

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
  $segmentPath = implode('/', array_slice($segments, 0, -2));
  $rootdir.=$segmentPath;
  //mkdir($rootdir, 0700, true);
  @recursive_mkdir($rootdir.'/');
  //die($rootdir); 
  $namespace = $segments[sizeof($segments)-2];
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