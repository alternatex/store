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
* @class Json
*/
class Json extends FileFormat {

  /**
  * Encode to format
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  protected function encode($data){
    return json_encode($data);
  }

  /**
  * Decode from format 
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  protected function decode($data){
    return json_decode($data);
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
  
}