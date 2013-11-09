<?php

class store_plugins_resource_Resource {
	public function __construct($data) {
		if(!php_Boot::$skip_constructor) {
		$this->data($data);
	}}
	public function data($data) {
		if($data !== null) {
			$this->__data = $data;
		}
		return $this->__data;
	}
	public $__data;
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
	function __toString() { return 'store.plugins.resource.Resource'; }
}
