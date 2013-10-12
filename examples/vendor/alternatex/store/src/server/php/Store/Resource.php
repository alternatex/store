<?php namespace Store;

/**
* Resource
*
* @class Resource
* @module Server
*/
abstract class Resource { 
  /**
  * Data
  * @property data
  * @private
  * @type {Array}
  * @default ''
  */
  protected $data = '';

  public function __construct($data){    
    $this->data($data);
  }

  public function data($data=null){
    if($data!==null) $this->data = $data;
    return $this->data;
  }
}