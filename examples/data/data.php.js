<?php
require_once(__DIR__.'/../../src/server/php/Store/Util/AMD.php');

// ...
$key = "data";
$data = array("hy", "my", "nmy", "ys");

// ...
printDataAsCommonJSModule($key, $data);