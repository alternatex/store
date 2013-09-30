<?php namespace Store\Driver;

use Store\Store;
use Store\Format\Object as ObjectFormat;
  
/**
* PHP Object Store 
*
* Store data using `serialize()`. Prototyping-Only.
* 
* TODO
* ----
* - IncludeWidespread.FilterData
* - Throw exception w/Store::MESSAGE_* » handle as json/jsonp generic (2)
*
* @class Object
* @deprecated use Store\Driver\File instead with an filename matching the target format
*/
class Object extends File {

  /**
  * Encode to format
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  protected function encode($data){
    return ObjectFormat::Encode($data);    
  }

  /**
  * Decode from format 
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  protected function decode($data){
    return ObjectFormat::Decode($data);    
  }
}