<?php namespace Store\Repository;

// TODO: 
// - thread-safety » file locks
// - load($data/collection)
// - persist » throw error? -> retrieve data from memory and store by external logic *
// - externalize sendResponse

use Store\Store;
use Store\Repository;
use Store\Repository\FileSystem;
use Store\Resource;
use Store\Resource\File;

/**
* Memory Store 
*
* @class Memory
* @module Server
*/
class Memory extends Repository {

  // file format(s)
  private $format = null;
  private $formats = array();

  /**
  * Encode to format
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  protected function encode($data){
    $format = $this->format;
    return $format::Encode(new File($data));
  }

  /**
  * Decode from format 
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  protected function decode($data){
    $format = $this->format;    
    return $format::Decode(new File($data));  
  }

  /**
  * Load repository 
  *
  * @method load
  * @param {String} $DSN
  * @void
  */ 

  // TODO: data ...
  public function load($dsn){

    // store *
    $this->datastore = $datastore = $dsn;

    // TODO: get format by file extension -> load into static property in function

    // determine/attach formatting helper (TODO: implement 4 real)    
    $this->format = 'Store\Format\Json'; // "Store\Format\\".(strpos($datastore, '.'.($jsonFormat::FILE_EXTENSION!==false?'Json':'Object')));

    // load from disk if exists
    if(file_exists($dsn)) { 

      // convert object data
      $this->items = $this->decode(file_get_contents($dsn)); 

      // handle format err
      if(!is_array($this->items)) { 
        $err = json_encode(array(Store::RESPONSE_ERROR => array("500" => Store::MESSAGE_ERROR_DATASTORE_CORRUPT)));
        die('console.error('.$err.');');        
      }
    }     
  }

  /**
  * Insert or update resource data in datastore
  *
  * @method update
  * @param {Object} $resource what it's about
  * @return {Boolean} Returns true on success
  */ 
  public function update(Resource $resource){

    // Quick Hack > TODO: solve properly
    $instance = $resource->data();

    $this->pending(true);

    // existing vs new
    if(is_numeric($index=$this->find($resource))) {

      // preserve files if empty *
      $preservefiles = $this->files($_FILES, $instance);
      foreach($preservefiles as $prop){
        if(trim($instance[$prop])==="") {
          $instance[$prop] = $this->items[$index][$prop];
        }         
      }
      $this->items[$index] = $instance;
      return $index;
    } else {
      if(!isset($instance[Store::ENTITY_IDENTIFIER]) && strlen(trim($instance[Store::ENTITY_IDENTIFIER]))==0) {
        $instance[Store::ENTITY_IDENTIFIER] = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
      }
      $this->files($_FILES, $instance);
      $this->items[] = $instance;
      
      return array(Store::ENTITY_COUNT => sizeof($this->items)-1);      
    }   
    return false;
  }

  /**
  * Removes a resource from datastore
  *
  * @method remove
  * @param {Object} $resource what it's about
  * @return {Boolean} Returns true on success
  */ 
  public function remove(Resource $resource){
    $instance = $resource->data();
    if(is_numeric($index=$this->find($resource))) {
      array_splice($this->items, $index, 1);
      $this->pending(true);
      return array(Store::ENTITY_COUNT => sizeof($this->items)-1);
    }
  }

  /**
  * Get resource data
  *
  * @method get
  * @param {Object} $resource what it's about
  * @return {Object} resource instance
  */ 
  public function get(Resource $resource=null){
    
    $instance = $resource!=null ? $resource->data() : null;

    if($instance==null) return $this->items;

    if(is_numeric($index=$this->find($resource))) {
      return $this->items[$index];
    }
    return false;
  }  

  /**
  * Find resource (currently just: UUID - TODO: enhance signature w/UUID as default / Widespread Merge ?!)
  *
  * @method find
  * @return {Array} List of item instances
  */ 
  public function find(Resource $resource){
    $instance = $resource->data();

    if(!isset($instance[Store::ENTITY_IDENTIFIER])) return false;
    $this->items = (array) $this->items;
    foreach($this->items as $index => $resource) {
      $resource = (array) $resource;
      if($resource[Store::ENTITY_IDENTIFIER]===$instance[Store::ENTITY_IDENTIFIER]) {
        return $index;
      }
    }  
    return false;
  } 

  /**
  * Filter resources
  *
  * @method find
  * @return {Array} List of matching resource instances
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
      $filesx = array_keys($files[Store::REQUEST_DATA][Store::TRANSFER_TARGET]);
      if(is_array($filesx)){
        foreach($filesx as $file){
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
  * Persist data
  * 
  * @method persist
  * @param {String} filepath
  * @param {String} contents
  * @void
  */ 
  public function persist($filepath, $content=null){

    $file = new File();
    $file->path($filepath);
    $file->content($content==null ? $this->encode($this->items) : $content);

    // ...
    return FileSystem::persistToDisk($file->path(), $file->content());
  }   
}