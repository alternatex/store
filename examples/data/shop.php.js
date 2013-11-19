<?php
require_once(__DIR__.'/../../src/server/php/Store/Store.php');
require_once(__DIR__.'/../../src/server/php/Store/Plugins/Repository/Repository.php');
require_once(__DIR__.'/../../src/server/php/Store/Plugins/Resource/Resource.php');
require_once(__DIR__.'/../../src/server/php/Store/Plugins/Resource/Item/Item.php');
require_once(__DIR__.'/../../src/server/php/Store/Plugins/Format/Format.php');
require_once(__DIR__.'/../../src/server/php/Store/Plugins/Format/CommonJs/CommonJs.php');

use Store\Store;
use Store\Plugins\Repository;
use Store\Plugins\Resource\Item\Item;
use Store\Plugins\Format\CommonJs;

// ...
header('content-type: application/javascript');
print CommonJs::Encode(new Item(@json_decode(@file_get_contents('../anonymous.resources.json'))));