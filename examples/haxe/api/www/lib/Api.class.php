<?php

class Api {
	public function __construct() {
		;
	}
	public function test($x, $y) {
		return $x + $y;
	}
	public $username;
	public $loginOkay;
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
	static $instance;
	static function main() {
		Api::$instance = new Api();
		$context = new haxe_remoting_Context();
		$context->addObject("api", Api::$instance, null);
		haxe_remoting_HttpConnection::handleRequest($context);
	}
	function __toString() { return 'Api'; }
}
