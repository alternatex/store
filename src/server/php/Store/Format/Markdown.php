<?php namespace Store\Format;

use Store\Format;

/**
* Markdown Formatted Contents
*
* @class Markdown
*/
class Markdown implements Format {

  const FILE_EXTENSION = 'md';
  
  /**
  * Encode to format
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public static function Encode($data){
    return die("Implement: ".__CLASS__."::".__FUNCTION__);
  }

  /**
  * Decode from format 
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public static function Decode($data){
    return die("Implement: ".__CLASS__."::".__FUNCTION__);
  }
}