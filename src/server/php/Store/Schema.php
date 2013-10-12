<?php namespace Store;

use Store\Resource;

/**
* Schema
*
* Abstract format aka content type (encoding/decoding)
*
* @class Schema
* @module Server
*/
interface Schema { 

  /**
  * Encode to format
  *
  * @method encode
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