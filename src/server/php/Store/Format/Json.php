<?php namespace Store\Format;

/**
* PHP Components *
*
* @module PHP
**/

/**
* Json Formatted Contents
*
* @class Json
*/
class Json extends Format {

  /**
  * Encode to format
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public function encode($data){
    return json_encode($data);
  }

  /**
  * Decode from format 
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public function decode($data){
    return json_decode($data);
  }
}