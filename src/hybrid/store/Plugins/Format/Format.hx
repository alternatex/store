package store.plugins.format;

import store.plugins.resource.Resource;

/**
* Format
*
* @interface Format
* @module Server
*/

//TODO: interface
class Format { 
  
  /**
  * Encode to format
  *
  * @method encode
  * @param {Resource} $resource to encode
  * @return {Dynamic} encoded resource
  */ 
  public static function Encode(resource:Resource):Dynamic {
    return null;
  }

  /**
  * Decode from format 
  *
  * @method decode
  * @param {Resource} $resource to decode
  * @return {Resource} decoded resource
  */ 
  public static function Decode(resource:Dynamic):Resource {
    return null;
  }

}
