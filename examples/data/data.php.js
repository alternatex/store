<?php
require_once(__DIR__.'/../../src/server/php/Store/Util/AMD.php');

// ...
$key = "data";
$data = array("hy", "my", "nmy", "ys");
$data = json_decode(file_get_contents('../anonymous.documents.xdat'));
$data = unserialize(file_get_contents('../anonymous.documents.dat'));
// ...
printDataAsCommonJSModule($key, $data);