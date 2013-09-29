<?php namespace Store\Driver;

use Store\Store;
use Store\Format\Json as JsonFormat;

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
* @deprecated use Store\Driver\File instead with an filename matching the target format
*/
class Json extends File {

  /**
  * Encode to format
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  protected function encode($data){
    return JsonFormat::Encode($data);
  }

  /**
  * Decode from format 
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  protected function decode($data){
    return JsonFormat::Decode($data);    
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