<?php namespace Store\Format;

use Store\Store;

/**
* PHP Components *
*
* @module PHP
**/

/**
* FileFormat
*
* Abstract file format content type (encoding/decoding)
*
* @class Object
*/
abstract class Format { 

  /**
  * Encode to format
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public static abstract function Encode($data);

  /**
  * Decode from format 
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
	public static abstract function Decode($data);
}