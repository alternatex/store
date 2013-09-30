<?php namespace Store\Format;

/**
* Json Formatted Contents
*
* @class Json
*/
class Json extends Format {

  const FILE_EXTENSION = 'json';
  
  /**
  * Encode to format
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public static function Encode($data){
    return json_encode($data);
  }

  /**
  * Decode from format 
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public static function Decode($data){
    return json_decode($data);
  }
}