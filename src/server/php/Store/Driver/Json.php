<?php namespace Store\Driver;

use Store\Store;
use Store\Format\Json as JsonFormat;

/**
* PHP Json Store 
*
* Store data using `json_encode()`. Prototyping-Only.
*
* @class Json
* @deprecated use Store\Driver\File instead with an filename matching the target format
*/
class Json extends File {

  /**
  * Encode to format
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  protected function encode($data){
    return JsonFormat::Encode($data);
  }

  /**
  * Decode from format 
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  protected function decode($data){
    return JsonFormat::Decode($data);    
  } 
}