package store.plugins.format.json;

import store.plugins.format.Format;
import store.plugins.resource.Resource;
import store.plugins.resource.file.File;
import store.plugins.resource.element.Element;

/**
* Json Formatting Helper
*
* @class Json 
* @module Server
*/
class Json extends Format { 
  
  /**
  * File extension
  * @property FILE_EXTENSION
  * @static
  * @type {String}
  */  
  private static var extension:String="json";

  /**
  * Encode to format
  *
  * @method encode
  * @param {Resource} $resource to encode
  * @return {Dynamic} encoded resource
  */ 
  public static override function Encode(resource:Dynamic):String{    
    return haxe.Json.stringify(resource);
  }

  /**
  * Decode from format 
  *
  * @method decode
  * @param {Resource} $resource to decode
  * @return {Resource} decoded resource
  */ 
  public static override function Decode(resource:String):Dynamic {
    return haxe.Json.parse(resource);
  }
}