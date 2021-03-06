<?php namespace Store\Format;

use Store\Format;
use Store\Resource;

/**
* CommonJS Module Passthrough For JSON Contents
*
* @class CommonJs
* @module Server
*/
class CommonJs implements Format {

  /**
  * File extension
  * @property FILE_EXTENSION
  * @const
  * @type {String}
  */
  const FILE_EXTENSION = 'cjs';
  
  /**
  * Encode to format
  *
  * @method encode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public static function Encode(Resource $resource){
    return str_replace(array("\n", "\t", "   ", "   ", "  "), "","
      (function (root, factory) {
        if (typeof define === 'function' && define.amd) {
          define(factory);
        } else {
          root.CommonJs = factory();
        }
      }(this, function () {
        return ".json_encode($resource->data()).";
      }));
    ");  
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