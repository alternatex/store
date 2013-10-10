<?php // TODO: CSRF protection

// load dropbox sdk
require_once(__DIR__.'/../assets/apps/dropbox-sdk/Dropbox/autoload.php');
use \Dropbox as dbx;

// dropbox request token
$authfile = __DIR__.'/../content/dropbox.auth';

// output/sync directory
$localPath="../content/";

// debug helpers
$num = 0;
$numAdds = 0;
$numRemoves = 0;

// load request token
list($accessToken, $host) = dbx\AuthInfo::loadFromJsonFile($authfile);

// initialize client
$client = new dbx\Client($accessToken, "examples-delta", 'en', $host);

// retrieve last cursor
$cursor = file_get_contents(__DIR__.'/../content/dropbox.cursor'); if(trim($cursor)==='') $cursor = null;

// fetch delta
$deltaPage = $client->getDelta($cursor);

// process results
foreach ($deltaPage["entries"] as $entry) {
  
  // key = path, value = path info
  list($lcPath, $metadata) = $entry;

  // don't process added directories (implicit -> metadata not set = removal - TODO: harmony)
  if($metadata['is_dir']) continue;

  // analyze path
  $path_parts = pathinfo($lcPath);

  // set directory & filepath
  $localDir = "../content/".$path_parts['dirname'];  
  $localPath = "../content/".$lcPath;  

  // create target file's directory if not exists yet (TODO: clean on removal?!)
  if(!file_exists($localDir)){
    echo "<br/>creating target folder: $localDir";
    mkdir($localDir, 0777, true);
  } else {
    echo "<br/>target folder exists: $localDir";
  }

  // remove file/directory
  if ($metadata === null) {
    echo nl2br("- $lcPath\n");
    echo "<br/>removing {$lcPath} to $localPath";
    if(file_exists($localPath)) if(!is_dir($localPath)) unlink($localPath); else rmdir($localPath);
    $numRemoves++;  
  }

  // add file  
  else {
    echo nl2br("+ $lcPath\n");
    echo "<br/>downloading {$lcPath} to $localPath";
    $metadata = $client->getFile($lcPath, fopen($localPath, "w"));  
    chmod($localPath, 0777);    
    $numAdds++;
  }

  // flush output for browser
  flush();

  // increment helper *
  $num++;
}

// debug
echo nl2br("Num Adds: $numAdds\n");
echo nl2br("Num Removes: $numRemoves\n");
echo nl2br("Has More: ".$deltaPage["has_more"]."\n");
echo nl2br("Cursor: ".$deltaPage["cursor"]."\n");

// update cursor
file_put_contents(__DIR__.'/../content/dropbox.cursor', $deltaPage["cursor"]);