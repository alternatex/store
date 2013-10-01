<?php
require_once(__DIR__.'/../../src/server/php/Store/Store.php');

use Store\Store;

// ...
$key = "data";
$data = @unserialize(@file_get_contents('../anonymous.documents.dat'));

// ...
Store::PrintCommonJSModule($key, $data);