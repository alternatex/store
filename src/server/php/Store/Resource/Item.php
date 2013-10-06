<?php namespace Store\Resource;

use Store\Resource;

/**
* Item aka Collection » TBD
* 
* @class Item
*/
class Item extends Resource { 

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