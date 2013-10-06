<?php
require_once(__DIR__.'/../../src/server/php/Store/Store.php');
require_once(__DIR__.'/../../src/server/php/Store/Repository.php');

use Store\Store;
use Store\Repository;

// ...
$key = "data";
//$data = @unserialize(@file_get_contents('../anonymous.documents.dat'));
$data = @unserialize(@file_get_contents('../anonymous.documents.json'));

// ...
Repository::PrintCommonJSModule($key, $data);