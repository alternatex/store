<?php namespace Store\Format;

use Store\Format;
use Store\Resource;

/**
* Interface Description
*
* @class CommonJs
* @module Server
*/
class Interface implements Format {

  /**
  * File extension
  * @property FILE_EXTENSION
  * @const
  * @type {String}
  */
  const FILE_EXTENSION = 'api';
  
  /**
  * Encode to format
  *
  * @method encode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public static function Encode(Resource $resource){
		throw new Error('Encoding not supported.');  
  }

  /**
  * Decode from format 
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public static function Decode(Resource $resource){
    throw new Error('Decoding not supported.');
  }
}