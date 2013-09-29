<?php
require_once(__DIR__.'/../../src/server/php/Store/Util/AMD.php');

// ...
$key = "data";
$data = @json_decode(@file_get_contents('../anonymous.documents.xdat'));

// ...
printDataAsCommonJSModule($key, $data);