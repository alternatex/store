<?php namespace Store;

/**
* Format fundamentals
*
* Abstract file format content type (encoding/decoding)
*
* @class Object
*/
interface Format { 

  /**
  * Encode to format
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public static function Encode($data);

  /**
  * Decode from format 
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public static function Decode($data);
}