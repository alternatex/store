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
  * Validate resource against schema
  *
  * @method Validate
  * @param {String} $datastore context identifier
  * @void
  */ 
  public static function Validate(Resource $resource);
}