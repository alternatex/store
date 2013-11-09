<?php

class store_Actions extends Enum {
	public static $create;
	public static $delete;
	public static $read;
	public static $update;
	public static $__constructors = array(0 => 'create', 3 => 'delete', 1 => 'read', 2 => 'update');
	}
store_Actions::$create = new store_Actions("create", 0);
store_Actions::$delete = new store_Actions("delete", 3);
store_Actions::$read = new store_Actions("read", 1);
store_Actions::$update = new store_Actions("update", 2);
