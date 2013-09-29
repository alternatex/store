<?php namespace Store\Driver;

use Store\Store;

/**
* PHP Components *
*
* @module PHP
**/

/**
* PHP Object Store 
*
* Store data using `serialize()`. Prototyping-Only.
* 
* TODO
* ----
* - IncludeWidespread.FilterData
* - Throw exception w/Store::MESSAGE_* » handle as json/jsonp generic (2)
*
* @class Server
* @constructor
*/
class Csv extends Object {

  /**
  * Items collection
  * @property data
  * @private
  * @type {Array}
  * @default array()
  */
  private $items = array();

  /**
  * Datastore filename
  * @property data
  * @private
  * @type {Array}
  * @default array()
  */
  private $datastore = null;

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
  * Insert or update item data in datastore
  *
  * @method update
  * @param {Object} $item what it's about
  * @return {Boolean} Returns true on success
  */ 
  public function update($instance){

    // existing vs new
    if(is_numeric($index=$this->find($instance))) {

      // preserve files if empty *
      $preservefiles = $this->files($_FILES, $instance);
      foreach($preservefiles as $prop){
        if(trim($instance[$prop])=="") {
          $instance[$prop] = $this->items[$index][$prop];
        }         
      }
      $this->items[$index] = $instance;
      return $index;
    } else {
      if(!isset($instance[Store::ENTITY_IDENTIFIER]) && strlen(trim($instance[Store::ENTITY_IDENTIFIER]))==0) {
        $instance[Store::ENTITY_IDENTIFIER] = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
      }
      $this->items[] = $instance;
      return array(Store::ENTITY_COUNT => sizeof($this->items)-1);      
    }
    return false;
  }

  /**
  * Removes an item from datastore
  *
  * @method remove
  * @param {Object} $item what it's about
  * @return {Boolean} Returns true on success
  */ 
  public function remove($instance){
    if(is_numeric($index=$this->find($instance))) {
      array_splice($this->items, $index, 1);
      return array(Store::ENTITY_COUNT => sizeof($this->items)-1);
    }
  }

  /**
  * Get item data
  *
  * @method get
  * @param {Object} $item what it's about
  * @return {Object} item instance
  */ 
  public function get($instance=null){
    
    if($instance==null) return $this->items;

    if(is_numeric($index=$this->find($instance))) {
      return $this->items[$index];
    }
    return false;
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
      if($entry[Store::ENTITY_IDENTIFIER]==$instance[Store::ENTITY_IDENTIFIER]) {
        return $index;
      }
    }  
    return false;
  }


  /**
  * Filter items
  *
  * @method find
  * @return {Array} List of matching item instances
  */ 
  public function filter($filter){
    // TODO: implement
    return array();
  }  

  /**
  * Process HTTP file uploads
  *
  * @method files
  * @param {Object} $files actually just $_FILES ...
  * @void
  */ 
  public function files(&$files, &$instance) {

    // handle files *
    $preservefiles = array();
    if(array_key_exists(Store::REQUEST_DATA, $files) && is_array($files[Store::REQUEST_DATA][Store::TRANSFER_TARGET])){
      $files = array_keys($files[Store::REQUEST_DATA][Store::TRANSFER_TARGET]);
      if(is_array($files)){
        foreach($files as $file){
          array_push($preservefiles, $file);
          if(strlen(trim($files[Store::REQUEST_DATA][Store::TRANSFER_SOURCE][$file]))){
            $instance[$file]='data: '.mime_content_type($files[Store::REQUEST_DATA][Store::TRANSFER_SOURCE][$file]).';base64,'.base64_encode(file_get_contents($files[Store::REQUEST_DATA][Store::TRANSFER_SOURCE][$file]));
          }
        }
      }
    }
    return $preservefiles;
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