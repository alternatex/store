<?php
require_once(__DIR__.'/../../src/server/php/Store/Util/AMD.php');

// ...
$key = "data";
$data = @unserialize(@file_get_contents('../anonymous.documents.dat'));

// ...
printDataAsCommonJSModule($key, $data);