<?php namespace Store\Format;

// TODO: Object store extends file system store call parent at the end -> process o real storage / gathering *

use Store\Format;
use Store\Resource;

/**
* Serialized Objects
*
* @class Object
*/
class Object implements Format {

  const FILE_EXTENSION = 'obj';

  /**
  * Encode to format
  *
  * @method decode
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