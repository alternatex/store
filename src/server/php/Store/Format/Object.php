<?php namespace Store\Format;

use Store\Format;
use Store\Resource;

/**
* Serialized Objects
*
* @class Object
* @module Server
*/
class Object implements Format {

  const FILE_EXTENSION = 'obj';

  /**
  * Encode to format
  *
  * @method encode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public static function Encode(Resource $resource){
    return serialize($resource->content());
  }

  /**
  * Decode from format 
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public static function Decode(Resource $resource){
    return unserialize($resource->content());
  }
}