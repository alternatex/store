<?php namespace Store;

// cookie ext *
// session_start();

// buffer output
ob_start();

// include core
include('../../src/server/php/Store/object.php');

// defaults
$user='anonymous';

// initialize store
$store = new ObjectStore();

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

// write response 
print json_encode($returnValue);

// retrieve buffer
$response = ob_get_clean();

// send response
print $store->response($dostore, $returnValue, $jsonp);