<?php namespace Store;

/**
* Protocol fundamentals
*
* Abstract transmission protocol content type (encoding/decoding)
*
* @class Protocol
*/
interface Protocol { 

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