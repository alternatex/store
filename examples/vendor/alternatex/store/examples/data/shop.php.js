<?php
require_once(__DIR__.'/../../src/server/php/Store/Store.php');
require_once(__DIR__.'/../../src/server/php/Store/Repository.php');
require_once(__DIR__.'/../../src/server/php/Store/Resource.php');
require_once(__DIR__.'/../../src/server/php/Store/Resource/Item/Item.php');
require_once(__DIR__.'/../../src/server/php/Store/Format.php');
require_once(__DIR__.'/../../src/server/php/Store/Format/CommonJs/CommonJs.php');

use Store\Store;
use Store\Repository;
use Store\Resource\Item;
use Store\Format\CommonJs;

// ...
header('content-type: application/javascript');
print CommonJs::Encode(new Item(@json_decode(@file_get_contents('../anonymous.resources.json'))));