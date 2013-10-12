<?php namespace Store\Format;

use Store\Format;
use Store\Resource;

// TODO: Make autoloading work -> re-run composer dependency fetch/autload generator
require_once(__DIR__.'/../../../../../vendor/PHP Markdown Lib 1.2.7/Michelf/Markdown.php');

use \Michelf\Markdown as MarkdownDecoder;

/**
* Markdown Formatted Contents
*
* @class Markdown
* @module Server
*/
class Markdown implements Format {

  const FILE_EXTENSION = 'md';
  
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
    return MarkdownDecoder::defaultTransform($resource->content());
  }
}