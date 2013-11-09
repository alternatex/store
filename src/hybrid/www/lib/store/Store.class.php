<?php

class store_Store extends store_Base {
	public function __construct() {
		if(!php_Boot::$skip_constructor) {
		parent::__construct();
	}}
	public function mirror() {
		haxe_Log::trace("mirror", _hx_anonymous(array("fileName" => "Store.hx", "lineNumber" => 390, "className" => "store.Store", "methodName" => "mirror")));
	}
	public function isPending($pending) {
		if($pending !== null) {
			$this->pending = $pending;
		}
		return $this->pending;
	}
	public function persist($dsn) {
		return true;
	}
	public function load($dsn) {
	}
	public function remove($resource) {
	}
	public function get($resource) {
	}
	public function update($resource) {
	}
	public $datastore;
	public $items;
	public $pending = true;
	public function __call($m, $a) {
		if(isset($this->$m) && is_callable($this->$m))
			return call_user_func_array($this->$m, $a);
		else if(isset($this->»dynamics[$m]) && is_callable($this->»dynamics[$m]))
			return call_user_func_array($this->»dynamics[$m], $a);
		else if('toString' == $m)
			return $this->__toString();
		else
			throw new HException('Unable to call «'.$m.'»');
	}
	static $REQUEST_HEADER_TYPE = "X-Store-Type";
	static $RESPONSE_JSONP_ENABLED = true;
	static $RESPONSE_JSONP_CALLBACK = "callback";
	static $ENTITY_COUNT = "count";
	static $ENTITY_IDENTIFIER = "id";
	static $MESSAGE_ERROR_DATASTORE_CORRUPT = "DATASTORE IS CORRUPT";
	static $MESSAGE_ERROR_DATASTORE_LOCKED = "DATASTORE IS LOCKED";
	static $REQUEST_ACTION = "action";
	static $REQUEST_NAMESPACE = "namespace";
	static $REQUEST_DATA = "instance";
	static $REQUEST_JSONP = "jsonp";
	static $RESPONSE_ERROR = "error";
	static $STORE_ACTION_GET = "get";
	static $STORE_ACTION_LIST = "list";
	static $STORE_ACTION_REMOVE = "remove";
	static $STORE_ACTION_UPDATE = "update";
	static $TRANSFER_SOURCE = "tmp_name";
	static $TRANSFER_TARGET = "name";
	static function test($test) {
		haxe_Log::trace($test, _hx_anonymous(array("fileName" => "Store.hx", "lineNumber" => 308, "className" => "store.Store", "methodName" => "test")));
	}
	static function main() {
		$resource = new store_plugins_resource_Resource(123);
		$mapping = _hx_anonymous(array("create" => store_Actions::$create, "read" => store_Actions::$read, "update" => store_Actions::$update, "delete" => store_Actions::$delete));
		haxe_Log::trace($mapping, _hx_anonymous(array("fileName" => "Store.hx", "lineNumber" => 432, "className" => "store.Store", "methodName" => "main")));
		haxe_Log::trace("hey there! wazzup???", _hx_anonymous(array("fileName" => "Store.hx", "lineNumber" => 433, "className" => "store.Store", "methodName" => "main")));
	}
	function __toString() { return 'store.Store'; }
}
