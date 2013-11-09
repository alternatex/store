<?php

class store_Colors {
	public function __construct(){}
	static function toInt($c) {
		return store_Colors_0($c);
	}
	function __toString() { return 'store.Colors'; }
}
function store_Colors_0(&$c) {
	$»t = ($c);
	switch($»t->index) {
	case 0:
	{
		return 16711680;
	}break;
	case 1:
	{
		return 65280;
	}break;
	case 2:
	{
		return 255;
	}break;
	}
}
