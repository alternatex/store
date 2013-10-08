<?php namespace Store\Format;

use Store\Format;
use Store\Resource;

/**
* Csv Formatted Contents
*
* @class Csv
* @module Server
*/
class Csv implements Format {

  const FILE_EXTENSION = 'csv';
  
  /**
  * Encode to format
  *
  * @method encode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public static function Encode(Resource $resource){
    return die("Implement: ".__CLASS__."::".__FUNCTION__);
  }

  /**
  * Decode from format 
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public static function Decode(Resource $resource){
    return die("Implement: ".__CLASS__."::".__FUNCTION__);
  }
}