<?php namespace Store\Format;

use Store\Format;
use Store\Resource;

/**
* Json Formatted Contents
*
* @class Json
* @module Server
*/
class Json implements Format {

  const FILE_EXTENSION = 'json';
  
  /**
  * Encode to format
  *
  * @method encode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public static function Encode(Resource $resource){
    return json_encode($resource->content());
  }

  /**
  * Decode from format 
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public static function Decode(Resource $resource){
    return json_decode($resource->content());
  }
}