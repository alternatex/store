<?php namespace Store;

use Store\Resource;

/**
* Schema
*
* Resource validation
*
* @class Schema
* @module Server
*/
interface Schema { 

  /**
  * Validate resource against schema
  *
  * @method validate
  * @param {Resource} $resource 
  * @void
  */ 
  public static function Validate(Resource $resource);
}