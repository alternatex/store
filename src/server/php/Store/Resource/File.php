<?php namespace Store\Resource;

// TODO: 
// - Implement format detection based on filename / mapping table (1st hardcoded, but within modular collection)

use Store\Resource, Store\Format;

/**
* File
*
* ...
*
* @class File
*/
class File extends Resource { 

  /**
  * Path to file
  * @property path
  * @private
  * @type {String}
  * @default ''
  */
  protected $path = '';

  /**
  * File content
  * @property content
  * @private
  * @type {String}
  * @default ''
  */
  protected $content = '';

  /**
  * File format
  * @property format
  * @private
  * @type {Format}
  * @default null
  */
  private $format = null;

  public function __construct($content=null, Format $format=null){    
    $this->content($content);
    $this->format($format);
  }

  public function format(Format $format=null){
    if($format!==null) $this->format = $format;
    return $this->format;
  }

  public function content($content=null, $free=false){
    if($content!=null || $free) $this->content = $content;
    return $this->content;
  }

  public function path($path=null, $free=false){
    if($path!=null || $free) $this->path = $path;
    return $this->path;
  }
}