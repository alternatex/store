package store.plugins.format;

import store.plugins.resource.Resource;

/**
* Format
*
* @interface Format
* @module Server
*/
class Format { 
  
  /**
  * File extension
  * @property FILE_EXTENSION
  * @static
  * @type {String}
  */  
  private static var extension:String=null;

  /**
  * Encode to format
  *
  * @method encode
  * @param {Resource} $resource to encode
  * @return {Dynamic} encoded resource
  */ 
  public static function Encode(resource:Dynamic):String {
    return null;
  }

  /**
  * Decode from format 
  *
  * @method decode
  * @param {Resource} $resource to decode
  * @return {Resource} decoded resource
  */ 
  public static function Decode(resource:String):Dynamic {
    return null;
  }

}
