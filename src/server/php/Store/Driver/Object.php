<?php namespace Store\Driver;

// TODO: Object store extends file system store call parent at the end -> process o real storage / gathering *

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
* @class Object
*/
class Object extends FileFormat {

  /**
  * Encode to format
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  protected function encode($data){
    return serialize($data);
  }

  /**
  * Decode from format 
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  protected function decode($data){
    return unserialize($data);
  }
}