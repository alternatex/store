<?php namespace Store\Driver;

// TODO: Implement when File got abstracted for json/object formats

use Store\Driver\FileSystem;

/**
* Markdown Plaintext Store 
*
* @class Markdown
* @constructor
* @deprecated use Store\Driver\File instead with an filename matching the target format
*/
class Markdown extends File {

  /**
  * Encode to format
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  protected function encode($data){
    return MarkdownFormat::Encode($data);
  }

  /**
  * Decode from format 
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  protected function decode($data){
    return MarkdownFormat::Decode($data);    
  } 
}