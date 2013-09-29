<?php namespace Store\Driver;

use Store\Store;

/**
* PHP Components *
*
* @module PHP
**/

/**
* PHP Json Store 
*
* Store data using `json_encode()`. Prototyping-Only.
*
* @class Server
* @constructor
*/
class Json extends Object {

  /**
  * Load repository 
  *
  * @method load
  * @param {String} $datastore context identifier
  * @void
  */ 
  public function load($datastore){
    
    // store *
    $this->datastore = $datastore;

    // load from disk if exists
    if(file_exists($datastore)) { 

      // convert object data
      $this->items = json_decode(file_get_contents($datastore)); 

      // handle format err
      if(!is_array($this->items)) { 

        // ... (2)
        $err = json_encode(array(Store::RESPONSE_ERROR => array("500" => Store::MESSAGE_ERROR_DATASTORE_CORRUPT.$class)));
        die(strlen($jsonp)>0 ? $jsonp."("."console.error(".$err."));":$err);        
      }
    }     
  }

  /**
  * Find item (currently just: UUID - TODO: enhance signature w/UUID as default / Widespread Merge ?!)
  *
  * @method find
  * @return {Array} List of item instances
  */ 
  public function find($instance){
    if(!isset($instance[Store::ENTITY_IDENTIFIER])) return false;
    $this->items = (array) $this->items;
    foreach($this->items as $index => $entry) {
      $entry = (array) $entry;
      if($entry[Store::ENTITY_IDENTIFIER]===$instance[Store::ENTITY_IDENTIFIER]) {
        return $index;
      }
    }  
    return false;
  }

  /**
  * Send output
  * 
  * @method response
  * @param {boolean} $dostore
  * @param {Array} $response
  * @param {String} $jsonp
  * @void
  */ 
  public function response($dostore, $response, $jsonp){

    // update datastore * perf *
    if($dostore) file_put_contents($this->datastore, json_encode($this->items));

    // send response
    if(strlen($jsonp)>0) {
      return $jsonp."(".json_encode($response).");";
    } else {
      return json_encode($response);
    }    
  }
}