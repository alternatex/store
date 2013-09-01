<?php

// initialize 
session_start();

// buffer output
ob_start();

// TODO: include autoloader?!?!?! -> update classes *
// TODO: include autoloader?!?!?! -> update classes *
// TODO: include autoloader?!?!?! -> update classes *

// TODO: CRSF....
// TODO: CRSF....
// TODO: CRSF.... 

require_once('vendor/autoload.php');

use \Store\Server\SocketServer as SocketServer;

$socketServer = new SocketServer('127.0.0.1', 8080);

// include access control helpers
require_once(__DIR__.'/../src/server/php/Store/Security/Auth.php');
require_once(__DIR__.'/../src/server/php/Store/Security/User.php');
require_once(__DIR__.'/../src/server/php/Store/Security/Token.php');

// determine store based on special header field
// x-store-type: object,markdown,... 4 client driven
// json configuration by path, ..... 4 server driven 

// defaults
$user='anonymous';

use \Store\Store as Store;

use \Store\Driver\BitTorrent as BitTorrent;

$bitTorrentClient = new BitTorrent(); 

// initialize storage
$Store = '\\Store\\Driver\\'.(false ? 'Object' : 'Markdown');

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
    $dostore = true;
    break;
  case Store::STORE_ACTION_REMOVE:
    $returnValue = $store->remove($instance);
    $dostore = true;
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

// ...
$devnull = ob_get_clean();

// send response
print $store->response($dostore, $returnValue, $jsonp);