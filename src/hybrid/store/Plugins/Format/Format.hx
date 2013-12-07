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
  private static var extension:String='';

  /**
  * Encode to format
  *
  * @method encode
  * @param {Dynamic} resource to encode
  * @return {String} encoded resource
  */ 
  public static function Encode(resource:Dynamic):String {
    return null;
  }

  /**
  * Decode from format 
  *
  * @method decode
  * @param {String} resource to decode
  * @return {Dynamic} decoded resource
  */ 
  public static function Decode(resource:String):Dynamic {
    return null;
  }

}
