<?php namespace Store;

use Store\Resource;

/**
* Dispatcher
*
* Message dispatcher
*
* @class Router
* @module Server
*/
class Dispatcher { 

  /**
  * Validate resource against schema
  *
  * @method Validate
  * @param {String} $datastore context identifier
  * @void
  */ 
  public static function Validate(Resource $resource);
}