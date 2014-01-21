<?php namespace Store\Format;

use Store\Format;
use Store\Resource;

use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

use Goodby\CSV\Export\Standard\Exporter;
use Goodby\CSV\Export\Standard\ExporterConfig;

/**
* Csv Formatted Contents
*
* @class Csv
* @module Server
*/
class Csv implements Format {

  /**
  * File extension
  * @property FILE_EXTENSION
  * @const
  * @type {String}
  */
  const FILE_EXTENSION = 'csv';
  
  /**
  * Encode to format
  *
  * @method encode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public static function Encode(Resource $resource){
    // TODO: a lot. hnd err, etc.
    ob_start(function($data){ return $data; });
    $exporter = new Exporter(new ExporterConfig());
    $exporter->export('php://output', $resource->content());
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
  }

  /**
  * Decode from format 
  *
  * @method decode
  * @param {String} $datastore context identifier
  * @void
  */ 
  public static function Decode(Resource $resource){

    // TODO: «non-silly-impl»

    // lazy lib work around
    $data = array();
    $tmpfilename = time().".tmp.csv";
    file_put_contents($tmpfilename, $resource->content());

    // setup lexer
    $lexer = new Lexer(new LexerConfig());
    $interpreter = new Interpreter();

    // do nothing
    $interpreter->addObserver(function(array $row) use (&$data) {
        $data[] = $row;
    });

    // process file
    $lexer->parse($tmpfilename, $interpreter);

    // cleanup
    unlink($tmpfilename);
    return $data;
  }
}