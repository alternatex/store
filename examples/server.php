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
use \Store\Driver\BitTorrent,
    \Store\Security\Auth,
    \Store\Security\Token,
    \Store\Security\User,
    \Store\Server\SocketServer,
    \Store\Store;

// TODO: implement (1st direct, 2nd by integration of `authenticate` library)
if(false){

  // user
  $user = new User('username', 'password');

  // authorization 
  $auth = Auth::GetInstance('acl.json');  
  $auth->validate($user);
}

// connect to socket
$socketServer = new SocketServer();

// retrieve request headers
$requestHeaders = getallheaders();

// extract storage type
if(isset($requestHeaders[HEADER_STORE_TYPE])) die($requestHeaders[HEADER_STORE_TYPE]);

// determine store based on special header field
// x-store-type: object/json,markdown,... 4 client driven -> limonade
// json configuration by path, ..... 4 server driven -> limonade
// -> limonade

// defaults
$user='anonymous';

// determine datastore filename
$datastore = $user.".".$namespace.'.json';

// debug helper
$objectStore = true;

// initialize storage
$Store = '\\Store\\Driver\\'.($objectStore ? 'File' : 'Markdown');

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
$datastore = $user.".".$namespace.(!$objectStore?'x':'').'.dat';

// load contents
$store->load($datastore);

// helper - store to disk *
$dostore = false;

// return value helper 
$returnValue = null;

// handle action *
switch($action){
  case Store::STORE_ACTION_UPDATE:
    $returnValue = $store->update($instance);
    $store->pending(true);
    break;
  case Store::STORE_ACTION_REMOVE:
    $returnValue = $store->remove($instance);
    $store->pending(true);
    break;
  case Store::STORE_ACTION_GET:
    $returnValue = $store->get($instance);
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

// send response
print $store->response($store->pending(), $returnValue, $jsonp);