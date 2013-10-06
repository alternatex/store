<?php namespace Store;

use Store\Resource;

/**
* Format
*
* Abstract format aka content type (encoding/decoding)
*
* @class Format
*/
interface Format { 

  /**
  * Encode to format
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public static function Encode(Resource $resource);

  /**
  * Decode from format 
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public static function Decode(Resource $resource);
}