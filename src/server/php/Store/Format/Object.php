<?php namespace Store\Format;

// TODO: Object store extends file system store call parent at the end -> process o real storage / gathering *

/**
* PHP Components *
*
* @module PHP
**/

/**
* Serialized Objects
*
* @class Object
*/
class Object extends Format {

  /**
  * Encode to format
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public function encode($data){
    return serialize($data);
  }

  /**
  * Decode from format 
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public function decode($data){
    return unserialize($data);
  }
}